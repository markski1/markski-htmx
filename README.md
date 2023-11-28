# markski-htmx

This is the code for my personal website, located at https://markski.ar.

It's entirely filesystem based, no database or anything.

You can simply copy and paste this repository on a webserver and change it up to make it your own.

For the routing to work, you'll need to refer to the .htaccess file in the case of Apache, or to nginx.conf for the case of NGINX. You'll have to adapt these to your already existing configuration, though.

#### Details

- Every .php file on the root directory is a page.
- Provided webserver configuration allows routing without visible extensions or query markers on the address bar.
- Posts contains .md files which are the blog posts.
- The /template/ directory contains the layout and "templating engine".
- HTMX is used for navigating from page to page without full page loads
- IE11 compatible.

#### Advantages compared to my previous Next.JS site:

- Extremely simple functionality: User requests a page, nginx fetches it, runs the php code, then returns it.
- Super lightweight on the client (sure, "it's a simple page", but it's only like 1kb of extra CSS from looking a lot better if I cared).
- 34kb total bundle for first time load.
- Only 2 lines of javascript: One for setting title when the page changes, and one for redirecting the user back to the route's root if required due to a rare bug with the blog's routing.

#### Disadvantages compared to my previous Next.JS site:

- Resuming the site (for example, ctrl + shift + t after closing the tab) will resume to a broken site if the user browsed on it. I'm not sure how to fix this yet but it seems like it should be simple.
- Routing is a little fudgy (refer to the last point of the "Advantages" section) but that might just be a skill issue on my part.
