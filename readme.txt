=== YB Selected Posts ===
Contributors:      Yorick Brown
Tags:              block
Tested up to:      6.5
Stable tag:        1.0.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Plugin which adds Gutenberg block which enables user to search for and select a published post to insert into the editor as a stylized anchor link.

The plugin also includes a custom WP-CLI command to search posts and display IDs of posts which contain this block.

Format for command is:
wp dmg-read-more search --date-before="[YYYY-MM-DD]" --date-after="[YYYY-MM-DD]"

For example:
wp dmg-read-more search --date-before="2024-05-11" --date-after="2023-04-11"

Running `wp dmg-read-more search` without the dates will return results from the previous 30 days.

In case of large datasets, the command has been optimised and currently is set to process batches of 100 (this may be adjusted according to server requirements) to ensure there is no memory overload or timeouts. The search also includes a progress indicator.

Future versions may include further optimisation for large datasets, including caching or streaming.

## Installation

1. Install the plugin through the WordPress plugins screen directly using the zip file provided.
2. Activate the plugin through the 'Plugins' screen in WordPress.

## Changelog

### 1.0.0
* MVP release.
