<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
class StatisticsControllerCore extends FrontController
{
    /** @var bool */
    public $display_header = false;
    /** @var bool */
    public $display_footer = false;

    protected $param_token;

    public function postProcess(): void
    {
        $this->param_token = Tools::getValue('token');
        if (!$this->param_token) {
            die;
        }

        $type = Tools::getValue('type');
        if ($type === 'navinfo') {
            $this->processNavigationStats();
        } elseif ($type === 'pagetime') {
            $this->processPageTime();
        } else {
            exit;
        }
    }

    /**
     * Log statistics on navigation (resolution, plugins, etc.).
     */
    protected function processNavigationStats(): void
    {
        $id_guest = (int) Tools::getValue('id_guest');
        if (!hash_equals(sha1($id_guest . _COOKIE_KEY_), (string) $this->param_token)) {
            die;
        }

        $guest = new Guest($id_guest);
        $guest->javascript = true;
        $guest->screen_resolution_x = (int) Tools::getValue('screen_resolution_x');
        $guest->screen_resolution_y = (int) Tools::getValue('screen_resolution_y');
        $guest->screen_color = (int) Tools::getValue('screen_color');
        $guest->sun_java = (int) Tools::getValue('sun_java');
        $guest->adobe_flash = (int) Tools::getValue('adobe_flash');
        $guest->adobe_director = (int) Tools::getValue('adobe_director');
        $guest->apple_quicktime = (int) Tools::getValue('apple_quicktime');
        $guest->real_player = (int) Tools::getValue('real_player');
        $guest->windows_media = (int) Tools::getValue('windows_media');
        $guest->update();
    }

    /**
     * Log statistics on time spend on pages.
     */
    protected function processPageTime(): void
    {
        $id_connection = (int) Tools::getValue('id_connections');
        $time = (int) Tools::getValue('time');
        $time_start = Tools::getValue('time_start');
        $id_page = (int) Tools::getValue('id_page');

        if (!hash_equals(sha1($id_connection . $id_page . $time_start . _COOKIE_KEY_), (string) $this->param_token)) {
            die;
        }

        if ($time <= 0) {
            die;
        }

        Connection::setPageTime($id_connection, $id_page, substr($time_start, 0, 19), $time);
    }
}
