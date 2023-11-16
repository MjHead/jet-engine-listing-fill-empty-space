# JetEngine - fill empty space in the Listing grid

This plugin allows to fill empty space for missed Listing Grid items if number of items in the Query results (items to show) is less then the requested items number. Works in 2 modes - placeholder and colspan (mode could be set with config)

Example of `placeholder` mode:
![image](https://user-images.githubusercontent.com/4987981/173502450-b1f4fa8c-db3e-43b8-ad98-f836423ab8fa.png)

Example of `colspan` mode:
![image](https://user-images.githubusercontent.com/4987981/174297286-99bf7105-6ebd-454f-bc3e-fc6a1c41f1ff.png)

Works only with JetEngine Query Builder queries

## Setup
- Download and install plugin,
- Define configuration constants in the end of functions.php file of your active theme,
- Add `fill_empty` into Query ID option of Query builder (maybe changed with configuration constants):
![image](https://user-images.githubusercontent.com/4987981/173502898-1fd847ea-1457-40d3-b18a-3445369cca60.png)

**Note!** If you using Listing Grid in combination with JetSmartFilters, you need to set 'fill_empty' also as listing ID and filter query ID

Configuration example:

``` php
  define( 'JET_ENGINE_FILL_LISTING_COLOR', '#eee' );
```

**Allowed constants:**

- `JET_ENGINE_FILL_LISTING_MODE` - by default `placeholder`. Defines how empty space will be filled `placeholder` - adds placeholders instead of missed items, `colspan` - stretch columns in last visible row
- `JET_ENGINE_FILL_LISTING_FOR_QUERY_ID` - by default `array( 'fill_empty' )`. Trigger for applying placeholders for listing with this query. You can replace initial query ID or add more query IDs to process
- `JET_ENGINE_FILL_LISTING_COLOR` - by default `#eee`. Color of the placeholder. Intended for `placeholder` mode.
- `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML` - by default `<div class="jet-engine-fill-box"></div>` - HTML markup of the placeholder. Intended for `placeholder` mode.
- `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT` - by default `false`. Placeholder height. By default stretches by height of current row. So if you have items in the row, it will be stretched by tallets item, if row is empty - placeholder will be collapsed. Intended for `placeholder` mode.

## Advanced

** Changing HTML markup ** 
With constant `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML` you can change HTML markup of placeholder to make it look more like your Listing Items itself. For example:
![image](https://user-images.githubusercontent.com/4987981/173504171-610a4e34-ca03-4201-b234-5c1be38f1034.png)
There is 2 important moment here:
- If you want to apply `JET_ENGINE_FILL_LISTING_COLOR` to each row of placeholder, you need to add `jet-engine-fill-box` class for these rows.
- Spacing and height you need to set with inline CSS

Here is example of the setup for the items on the screenshot:
```php
define( 'JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML', '<div class="jet-engine-fill-box" style="height: 24px; margin: 15px 0 10px; width: 50%;"></div><div class="jet-engine-fill-box" style="height: 18px; margin: 5px 0 15px;"></div>' );
```

** Custom height **
As I said before, by default placeholder items stretched by the height of tallest item in the row, so if row has no items, it will be collapsed. What I mean - for example you requested 12 items from the DB and set 3 columns for the listing. So you should to get 4 rows of listing grid items with 3 items in the row. If you have only 5 items to show, by default - 1st row has all 3 items to show, 2nd - has 2 items, placeholder will be added instead 3rd and placeholder will be stretched by height of the tallest items in the row. Rows 3 and 4 has no items to show, so it will be filled with placeholders, but placeholders will collapse, because rows has no visible items. It will be look like this:

![image](https://user-images.githubusercontent.com/4987981/173505433-1955a48e-91cb-402f-a72c-4aeee53e788b.png)

So if you need to show all 12 items, you need to set fixed placeholder height, with `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT` constant or fixed height for rows of the placeholder with `JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML` constant. In this case you'll get something like this:

![image](https://user-images.githubusercontent.com/4987981/173511734-dfdd208d-3119-4134-a793-c23398a7a250.png)

