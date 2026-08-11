<?php

namespace App;

use Wpwwhimself\Shipyard\Theme;

class ShipyardTheme
{
    use Theme;

    #region theme
    /**
     * Available themes:
     * - origin - separated cells, clean background, contents floating in the middle
     * - austerity - broad background, main sections spread out
     */
    public const THEME = "origin";
    #endregion

    #region colors
    /**
     * App accent colors:
     * - primary - for background, primary (disruptive) actions and important text
     * - secondary - for default buttons and links
     * - tertiary - for non-disruptive interactive elements
     *
     * If value is an array, 2 different colors may be used for light/dark mode
     */
    public const COLORS = [
        "primary" => "#cee955",
        "secondary" => "#88b420",
        "tertiary" => "#e9d73b",
    ];
    #endregion

    #region fonts
    /**
     * type in the fonts as an array
     */
    public const FONTS = [
        "base" => ["Tektur", "sans-serif"],
        "heading" => ["Tektur", "sans-serif"],
        "mono" => ["Kode Mono", "monospace"],
    ];

    // if fonts come from Google Fonts, add the URL here
    public const FONT_IMPORT_URL = 'https://fonts.googleapis.com/css2?family=Kode+Mono:wght@400..700&family=Tektur:wght@400..900&display=swap';
    #endregion

    #region optional modules
    /**
     * list of optional includes to extend functionalities of this app
     * uncomment those you need
     */
    public const MODULES = [
        // "sheetmusic",
        // "wysiwyg",
    ];
    #endregion
}
