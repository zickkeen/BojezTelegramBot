<?php

/**
 * This file is part of the BojezTelegramBot example-bot package.
 * https://github.com/zickkeen/BojezTelegramBot/
 *
 * (c) BojezTelegramBot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * User "/wiki" command
 *
 * Get wikipedia info for the title passed as the parameter..
 *
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\TelegramLog;

class WikiCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'wiki';

    /**
     * @var string
     */
    protected $description = 'Show short description from wikipedia';

    /**
     * @var string
     */
    protected $usage = '/wiki <title>';

    /**
     * @var string
     */
    protected $version = '1.0.1';

    /**
     * Base URI for wikipedia API
     *
     * @var string
     */
    private $wikipediaApi = 'https://id.wikipedia.org/w/';

    /**
     * Get wiki data using HTTP request
     *
     * @param string $title
     *
     * @return string
     */
    private function getWikiData($title): string
    {
        $client = new Client(['base_uri' => $this->wikipediaApi]);
        $path   = 'api.php';
        $query  = [
            'format'        =>'json',
            'action'        =>'query',
            'prop'          =>'extracts',
            'exintro'       =>1,
            'explaintext'   =>1,
            'redirects'     =>1,
            'indexpageids'  =>1,
            'titles'=>trim($title)
        ];

        try {
            $response = $client->get($path, ['query' => $query]);
        } catch (RequestException $e) {
            TelegramLog::error($e->getMessage());
            return '';
        }

        return (string) $response->getBody();
    }

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $title = trim($this->getMessage()->getText(true));
        if ($title === '') {
            return $this->replyToChat('You must specify a title as: ' . $this->getUsage());
        }

        $text = 'Cannot find data for title: ' . $title;
        if ($wiki_data = (object) json_decode($this->getWikiData($title), false)) {

            $result     = $wiki_data->query;
            $pagesId    = $result->pageids[0];
            $text       = $result->pages->{$pagesId}->extract ?? "Title {$title} not found";
            return $this->replyToChat($text);
        }else{
            return $this->replyToChat('this is bug, report to admin @BojezCreative');
        }
        
    }
}
