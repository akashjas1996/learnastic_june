<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Component\Editor\CkEditor\Toolbar;

/**
 * Documents toolbar configuration.
 *
 * @package Chamilo\CoreBundle\Component\Editor\CkEditor\Toolbar
 */
class Documents extends Basic
{
    public $plugins = [];

    /**
     * Get the toolbar config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = [];

        if (api_get_setting('more_buttons_maximized_mode') !== 'true') {
            $config['toolbar'] = $this->getNormalToolbar();
        } else {
            $config['toolbar_minToolbar'] = $this->getMinimizedToolbar();
        }

        $config['extraPlugins'] = $this->getPluginsToString();
        $config['fullPage'] = true;

        return $config;
    }

    /**
     * @return array
     */
    public function getConditionalPlugins()
    {
        $plugins = [];

        if (api_get_setting('show_glossary_in_documents') === 'ismanual') {
            $plugins[] = 'glossary';
        }

        return $plugins;
    }

    /**
     * Get the default toolbar configuration when the setting more_buttons_maximized_mode is false.
     *
     * @return array
     */
    protected function getNormalToolbar()
    {
        return [
            ['Maximize', 'PasteFromWord', '-', 'Undo', 'Redo'],
            ['Link', 'Unlink', 'Anchor', 'inserthtml', 'Glossary'],
            [
                'Image',
                'Video',
                'Flash',
                'Oembed',
                'Youtube',
                'Audio',
                'Asciimath',
                'Asciisvg',
            ],
            ['Table', 'SpecialChar'],
            [
                'Outdent',
                'Indent',
                '-',
                'TextColor',
                'BGColor',
                '-',
                'NumberedList',
                'BulletedList',
                '-',
                api_get_configuration_value('translate_html') ? 'Language' : '',
                api_get_setting('allow_spellcheck') === 'true' ? 'Scayt' : '',
            ],
            '/',
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['Bold', 'Italic', 'Underline'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            api_get_setting('enabled_wiris') === 'true' ? ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS'] : [''],
            ['Source'],
        ];
    }

    /**
     * Get the toolbar configuration when CKEditor is minimized.
     *
     * @return array
     */
    protected function getMinimizedToolbar()
    {
        return [
            $this->getNewPageBlock(),
            ['Undo', 'Redo'],
            [
                'Link',
                'Image',
                'Video',
                'Flash',
                'Youtube',
                'Audio',
                'Table',
                'Asciimath',
                'Asciisvg',
            ],
            ['BulletedList', 'NumberedList', 'HorizontalRule'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
            ['Styles',
                'Format',
                'Font',
                'FontSize',
                'Bold',
                'Italic',
                'Underline',
                'TextColor',
                'BGColor',
            ],
            [
                api_get_configuration_value('translate_html') ? 'Language' : '',
                'ShowBlocks',
            ],
            api_get_setting('enabled_wiris') === 'true' ? ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS'] : [''],
            ['Toolbarswitch'],
            ['Source'],
        ];
    }
}
