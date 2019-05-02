# Voyager 的介紹以及使用 (二) Blog 管理

voyager 是個 CRUD 的好幫手，相信各位同好已經玩過了，沒有玩過可以先看過我的第一篇 [Voyager 的介紹以及使用 (一)
](https://www.prgpress.com/voyager-de-jie-shao-yi-ji-shi-yong/)，增加自己的印象

這一篇是針對沒有玩過的人而寫出來，增加自己與旁人的印象，希望大家有個基礎吧，裏面的 DB 沒有用過很高級的技巧，希望看過的同好給予指教

### Laravel 剛開始的畫面

這是它原本的畫面，表示你的伺服器目前是運作的很好，現在要針對它來進行修改，找到樣板之後的修改，所需要的時間大概 10~20 分鐘就可以了

![ori welcome](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/ori_welcome.png)


### 先找個樣板來用

從 ColorLib 去找，有蠻多的免費樣板，只是要保留它的 footer 建立的文字就可以使用，現在都以免費的爲主

Stuff： [https://colorlib.com/wp/template/stuff/](https://colorlib.com/wp/template/stuff/)

樣板有了，只是需要做大幅度的修改才行，畢竟只有 Blog

這是 Stuff 樣板原本的樣子

![原本的樣板](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/stuff_template.png)

### 前臺開始修改

一開始看直接去看 routes/web.php

原本是這個樣子，直接由 welcome 這個 view 爲主

```
Route::get('/', function(){
    return view('welcome');
});
```  

我先用 php artisan 建立一個 Controller

```
php artisan make:controller HomeController 
```

再來開啓 HomeController.php，在它的 class 底下建立如下

```
public function home(){
    return view('layouts.app');
}
```

先在 views 建立 layouts/app.blade.php
然後複製樣板的 index.html 進去

這時候可以看到它的畫面，是跟 Stuff 的畫面一樣


### 修改程式以及樣板

修改樣板變成這樣，把它的選單、文字以及大圖都拿掉
還有 css、fonts、images、js、sass 這些都複製到 public 底下

還有 layouts/app.blade.php 樣板裏面，只要是載入 css 以及 js 的部分，全部改爲載入 asset('載入的檔案') 

![修改過的樣板](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/fix_template_1.png)

就讓它單純只是 Blog 

#### 樣板的規劃

layouts/app.blade.php 是只要的樣板，其它都是依附它延伸出來的

詳細的看樣板如何做的

```
app.blade.php
blog/view.blade.php
layouts/app.blade.php
```

接着 Post 就有 5 篇文章，這 5 篇文章的內容是取自 [假文產生器 MoreText](http://more.handlino.com/)
這些不是讓大眾閱讀，而是亂數假文產生器去產生的內容，看排版的狀況

後端的 Post 的文章

![修改過的樣板](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/admin_posts.png)

#### 修改 HomeController

把 HomeController 調整

```
use TCG\Voyager\Models\Post;

...

public function home(){

    $posts = Post::select('posts.*', 'categories.name', 'posts.id as post_id')
        ->join('categories', 'categories.id', '=', 'posts.category_id')
        ->where('posts.status', '=', 'PUBLISHED')->orderBy('posts.id', 'desc')->get();
    
    return view('app', ['posts' => $posts]);
}
```

他會出現如圖，感覺有點樣子了

![修改的樣子](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/fix_template.png)

#### 建立一個 Blog 的 Controller 吧

直接輸入下方的指令

```
php artisan make:controller BlogController 
```

這裏只是有個地方不一樣，因爲載入的資料只有一筆，所以會有不同的地方

```
public function home($id){

    $post = Post::join('categories', 'categories.id', '=', 'posts.category_id')
                ->where([['posts.status', 'PUBLISHED'], ['posts.id', $id]])->first();

    return view('blog.view', ['post' => $post]);

}
```

直接瀏覽器去測試，可以看到 Post 的標題、內容、圖檔、類別、日期等，看看是否列出來

![修改的樣子](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/post_article.png)

然後 Developer Tools 可以列出來 Facebook 以及 Twitter 只要屬於分享的部分，直接就可以列出來的方式

![Facebook & Twitter](https://raw.githubusercontent.com/zivhsiao/repo-picture-1/master/images/voyager_blog/developer_tools.png)

這樣就完成了
