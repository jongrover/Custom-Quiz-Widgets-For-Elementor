!function(n,t){"use strict";var i={init:function(){var o={"elementskit-blog-posts.default":i.BlogPosts};n.each(o,function(n,i){t.hooks.addAction("frontend/element_ready/"+n,i)})},BlogPosts:function(t){var i=t.find(".ekit-blog-post-pagination-container"),o=t.data("id"),e={items:"#post-items--"+o,nagivation:"#post-nagivation--"+o};t.on("click",".ekit-blog-post-pagination-container a.page-numbers",function(o){o.preventDefault();var a=n(this).attr("href");n.ajax({url:a}).done(function(o){var a=n(o),s=a.find(e.items).html(),r=a.find(e.nagivation).html();"loadmore"==i.data("ekit-blog-post-style")?t.find(e.items).append(s):t.find(e.items).html(s),t.find(e.nagivation).html(r)})})},BlogPostsMasonry:function(n){}};n(window).on("elementor/frontend/init",i.init)}(jQuery,window.elementorFrontend);