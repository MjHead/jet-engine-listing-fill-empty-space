# JetEngine - fill empty space in the Listing grid

This plugin allows to add placeholders for missed Listing Grid items if number of items in the Query results (items to show) is less then the requested items number.

Example:
![image](https://user-images.githubusercontent.com/4987981/173502450-b1f4fa8c-db3e-43b8-ad98-f836423ab8fa.png)

Works only with JetEngine Query Builder queries

## Setup
- Download and intall plugin,
- Define configuration constants in the end of functions.php file of your active theme,
- Add 'fill_empty' into Query ID option of Query builder (may be changed with configuration constants):
![image](https://user-images.githubusercontent.com/4987981/173502898-1fd847ea-1457-40d3-b18a-3445369cca60.png)

**Note!** If you using Listing Grid in combination with JetSmartFilters, you need to set 'fill_empty' also as listing ID and filter query ID

Configuration example:

``` php
  define( 'JET_ENGINE_FILL_LISTING_COLOR', '#eee' );
```

**Allowed constants:**

- `JET_ENGINE_FILL_LISTING_FOR_QUERY_ID` - by default 'fill_empty'. Trigger for applying placeholders for listing with this query,
- `JET_ENGINE_FILL_LISTING_COLOR` - by default '#eee'. Color of the placeholder.
- `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML` - by default `<div class="jet-engine-fill-box"></div>` - HTML markup of the placeholder.
- `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT` - by default `false`. Placeholder height. By default stretches by height of current row. So if you have items in the row, it will be stretched by tallets item, if row is empty - placeholder will be collapced

## Advanced

** Changing HTML markup ** 
With constant `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML` you can change HTML markup of placeholder to make it look more like your Listing Items items itself. For example:
![image](https://user-images.githubusercontent.com/4987981/173504171-610a4e34-ca03-4201-b234-5c1be38f1034.png)
Tere is 2 importnat moment here:
- If you want to apply `JET_ENGINE_FILL_LISTING_COLOR` to each row of placeholder, you need to add `jet-engine-fill-box` class for these rows.
- Spacing and height you need to set with inline CSS

Here is example of the setup for the items on the screenshot:
```php
define( 'JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML', '<div class="jet-engine-fill-box" style="height: 24px; margin: 15px 0 10px; width: 50%;"></div><div class="jet-engine-fill-box" style="height: 18px; margin: 5px 0 15px;"></div>' );
```

