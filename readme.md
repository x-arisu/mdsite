mdsite - Markdown based website
-------------------------------

mdsite is a markdown ([Parsedown](https://github.com/erusev/parsedown)) based site built on files and directories. (No databases)

mdsite is the successor to [uwusite](https://github.com/ArisuUwU/uwusite), which is built from a similar concept

#### Improvements over uwusite
One of the many issues with uwusite is that it relied on copying php files all around. This takes away time from actually writing pages and adds an unnecessary barrier of entry for those who want to setup their own site.

mdsite solves that by being even simpler. All you need to do is modify the config to your liking. Then you can start writing your site with markdown. **ALL** markdown, your indexes are markdown. Your pages are markdown. Your directories can even use markdown!

**Styling.** The CSS for uwusite was a bit messy and customizing just the colorscheme was a bit of a headache at times. So for mdsite I decided to go with [sakura css](https://github.com/oxalorg/sakura) which has nice defaults and has multiple other colorschemes you can choose from.

Another issue is mobile friendliness. While mdsite isn't perfect in this regard, it is still miles better than uwusite.

#### Missing/Dropped features from uwusite
- RSS support

#### Setup
1. clone the repo 
	```
	git clone https://github.com/ArisuUwU/mdsite
	```
2. make changes to the `static/config.php` file
3. use nginx or apache to serve the directory and php
4. edit / build upon the examples provided and make your very own markdown site

#### Things to note
Directories without an `index.md` can have a `header.md` and/or `footer.md`, which will be added to the directory listing page. Directories only list markdown files and directories.

#### Updating your site
Updating is as simple as dowloading the latest `index.php` and updating your config if needed.
test
