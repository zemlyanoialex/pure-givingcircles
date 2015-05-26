# Pure Charity Giving Circles

A plugin to display one or a list of your Giving Circles from the Pure Charity app.

## Installation

In order to install the plugin:

1. Copy the `/purecharity-wp-givingcirles` folder to the `/wp-content/plugins` on your WP install
2. Activate the plugin through the ‘Plugins’ menu in WordPress
3. You’re done!

## Template Tags

### Giving Circles List

Function: 
`pc_giving_circles()`

Returns:
A Giving Circle `Object`

Return Object Attributes:
* `name` - string
* `members_count` - string
* `profile` - object
	* `about` - string
	* `lives_impacted` - int
	* `cover` - string(image_url)
	* `avatar` - string(image_url)
* `total_donations` - string
* `slug` - string

Example (show a list of giving circles with name and members_count in a page):

```php
	<?php $gc_list = pc_giving_circles(); ?>
	<ul>
		<?php foreach($gc_list as $gc){ ?>
			<li>	
				<?php echo $gc->name ?>
				<small><?php echo $gc->members_count ?></small>
			</li>
		<?php } ?>
	</ul>
```

### Single Giving Circle Information

Function: 
`pc_giving_circle($slug)`

Parameters:
* $slug - The slug of the giving circle you want to fetch.

Returns:
A Giving Circle `Object`

Return Object Attributes:
* `name` - string
* `about` - string
* `profile` - object
	* `about` - string
	* `lives_impacted` - int
	* `cover` - string(image url)
	* `avatar` - string(image url)
* `founder` - object
	* `name` - string
	* `profile_url` - string
	* `avatar` - string(image url)
* `organizers` - array of objects
	* `name` - string
	* `profile_url` - string
	* `avatar` - string(image url)
* `membership_status` - string
* `minimum_monthly_donation` - string
* `backed_causes` - array of objects
	* `name` - string
	* `url` - string
	* `amount_donated` - string
	* `location` - string
	* `avatar` - string(image_url)
* `total_donations` - string
* `members` - array of objects
	* `name` - string
	* `profile_url` - string
	* `avatar` - string(image url)
* `join_url` - string

Example (show a giving circle's name and members_count in a page):

```php
	<?php $gc = pc_giving_circle('my-giving-circle'); ?>
	<h1>	
		<?php echo $gc->name ?>
		<small><?php echo count($gc->members) ?></small>
	</h1>
```

## Shortcodes

### Single Giving Circle Information

`[giving_circle_info slug=my-gc type=info_type]`

Available Types:

* `members_count` - String
* `amount_donated` - Money formatted String
* `member_avatars`- Unordered list with the avatars of all the giving circle members


## Contents

The Pure Charity Giving Circles includes the following files:

* `.gitignore`. Used to exclude certain files from the repository.
* `ChangeLog.md`. The list of changes to the core project.
* `README.md`. The file that you’re currently reading.
* A `purecharity-wp-givingcircles` subdirectory that contains the source code - a fully executable WordPress plugin.

## Features

* The Plugin is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards), and [Documentation Standards](http://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/).

## Installation

The Giving Circles plugin requires the Pure Charity Base Plugin

## License

TODO.

### Licensing

TODO.