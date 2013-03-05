pyro-pagewidgets-field
======================

Add widgets to a page by selecting the widget and then ordering it.

Steps
-----

* Create an area for page specific widgets
* Create widgets as normal and place them in that area
* Add the field to a page and choose that area as the source
* Go to a page with that type and choose widgets from the multiselect
* Order them with the sortable list

### Field Creation

![Field Creation](http://files.getcloudapp.com/items/3G3j1H3B01432d2s2z31/Screen%20Shot%202013-03-05%20at%2012.08.12%20PM.png)

### Field during page edit

![Order Items](http://files.getcloudapp.com/items/0G0v263e2L120A2r433Q/Screen%20Shot%202013-03-05%20at%2012.10.14%20PM.png)

Template Usage
--------------

Fairly easy. Still uses the native/included widgets:instance plugin

``` html
<div class="a-bunch-of-page-widgets">
  {{ my_pagewidgets_field_slug }}
    {{ widgets:instance id=id }}
  {{ /my_pagewidgets_field_slug }}
</div>
```

Why
---

Clients kept asking to add a widget to a specific page and they were reluctant to learn how to use the widgets short code. Also for my own piece of mind I didn't want them editing templates and breaking stuff.

Now they can manage their widgets on a page-by-page basis instead of area-by-area. Of course area widgets still work but it is up to the template to decide what order to set them in.

``` html
<div class="a-bunch-of-page-widgets">
  {{ widgets:area slug="left-sidebar" }}
  {{ my_pagewidgets_field_slug }}
    {{ widgets:instance id=id }}
  {{ /my_pagewidgets_field_slug }}
</div>
```

Of course this is what I mean. The widgets in the left-sidebar area will come first and then the widgets assigned to the page will follow.


License
-------

(The MIT License)

Copyright (c) 2013 James Doyle(james2doyle) <james2doyle@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.