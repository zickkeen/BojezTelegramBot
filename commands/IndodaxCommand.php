<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * User "/weather" command
 *
 * Get weather info for the location passed as the parameter..
 *
 * A OpenWeatherMap.org API key is required for this command!
 * You can be set in your config.php file:
 * ['commands']['configs']['weather'] => ['owm_api_key' => 'your_owm_api_key_here']
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\TelegramLog;

class IndodaxCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'indodax';

    /**
     * @var string
     */
    protected $description = 'Show price market from indodax now';

    /**
     * @var string
     */
    protected $usage = '/indodax <coin>';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Base URI for Indodax API
     *
     * @var string
     */
    private $owm_api_base_uri = 'https://indodax.com/api/';

    /**
     * Get market data using HTTP request
     *
     * @return object
     */
    private function getMarketData(): object
    {
        $client = new Client(['base_uri' => $this->owm_api_base_uri]);
        $path   = 'summaries';

        try {
            $response = $client->get($path);
        } catch (RequestException $e) {
            TelegramLog::error($e->getMessage());

            return '';
        }

        return (object) json_decode($response->getBody(), false);
    }

    /**
     * for number format
     * 
     * @param float $number
     * 
     * @param int $dec
     * 
     * @return string 
     */

    private function fNumber(float $number,$dec=0): string
    {
        return number_format($number,$dec,",",".");
    }

    /**
     * Get market string from market data
     *
     * @param object $data
     *
     * @param string $coin
     * 
     * @return string
     */
    private function getMarketString(object $data, string $coin): string
    {
        try {
            if (!(isset($data->tickers))) {
                return 'no data';
            }

            $market = $data->tickers;

            if(isset($coin) && $coin == 'all'){
                $textString = 'List of price coin in a Indodax:' . PHP_EOL;
                foreach($market as $aCoin)
                {
                    // foreach($aCoin as $l => $v)
                    // {
                    //     echo $l . '=>' . $v . PHP_EOL;
                    //     if($l == 'last') $valCoin['price'] = $v;
                    //     if($l == 'name') $valCoin['price'] = $v;
                    // }
                    $textString .= $aCoin->name . ': '. $this->fNumber($aCoin->last) . PHP_EOL;
                }

                return $textString;
            }

            if(isset($coin) && $coin != 'all'){
                $data = $market->{$coin.'_idr'} ?? 0;
                if($data){
                    return sprintf(
                        'high: %s,' . PHP_EOL .
                        'low: %s,' . PHP_EOL .
                        "Volume {$coin}: %s," . PHP_EOL .
                        'Volume idr: %s,' . PHP_EOL .
                        'last: %s,' . PHP_EOL .
                        'buy: %s,' . PHP_EOL .
                        'sell: %s,' . PHP_EOL .
                        'server_time: %s,' . PHP_EOL .
                        'name: %s',
                        $this->fNumber($data->high),
                        $this->fNumber($data->low),
                        $this->fNumber($data->{'vol_'.$coin},2),
                        $this->fNumber($data->vol_idr,2),
                        $this->fNumber($data->last),
                        $this->fNumber($data->buy),
                        $this->fNumber($data->sell),
                        date("d-M-Y H:i:s",$data->server_time),
                        $data->name
                    );
                }else{
                    return false;
                }
            }
            
        } catch (Exception $e) {
            TelegramLog::error($e->getMessage());
            return false;
        }
    }

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {

        $coin = trim($this->getMessage()->getText(true));
        if ($coin === '') {
            $coin = 'all';
        }
        
        if ($market_data = $this->getMarketData()) {
            if($this->getMarketString($market_data,$coin) != false){
                $text = $this->getMarketString($market_data,$coin);
                $text .= PHP_EOL . 'Thanks for using our service (https://www.bojez.com)';
            }else{
                $text = 'Cannot find market for coin: ' . $coin;
            }
        }else{
            $text = 'Cannot find indodax market';
        }
        return $this->replyToChat($text);
    }
}
