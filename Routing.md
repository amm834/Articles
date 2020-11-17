# Model View Controller 
- ( Practical Approach)

## Prerequisites
- Basic Concept Of MVC
https://www.facebook.com/483794355524551/posts/819344871969496/

## Routing Setup

MVC နဲ့ပတ်သက်လို့သိသင့်သိထိုက်တဲ့အခြေခံ Concept တွေကို ဖော်ပြပြီးဖြစ်ပါတယ်။
ယခု Article မှာ လက်တွေ့လေ့လာလိုသူတွေအတွက်ဖြစ်ပါတယ်။
ကျွန်တော်အသုံးပြုသွားမယ့် Web Programming Language ကတော့ PHP ဖြစ်ပါတယ်။သို့မဟုတ် MVC Pattern နဲ့ရေးလို့ရတဲ့ ASP.Net, Python,Java တို့နှင့်လည်းမိမိဘာသာချဲ့ထွင်ရေးသားနိုင်မှာဖြစ်ပါတယ်။
Web Application တွေမှာ လက်ပွန်းတနှီးထိတွေ့နေရတာက Website URL တွေဖြစ်ပါတယ်။
Route လို့ခေါ်ပါတယ်။ယခု Article မှာ Route လို့ပဲသုံးနှုန်းသွားမှာဖြစ်ပါတယ်။
(ယခု Article မှာပါရှိတဲ့ Code တွေက PHP OOP ကိုအခြေခံအဆင့်လောက်ရရှိပြီးသားဖြစ်ရပါမယ်။)
ပထမဆုံး Route ကို Setting ချရမှာဖြစ်တဲ့အတွက်ကျွန်တော်သုံးနေတဲ့နည်းတွေထဲက ခုမှစလေ့လာတဲ့သူတွေအတွက်ပိုမိုလွယ်ကူစေမဲ့ Apache Rewrite ပြီးတော့ရေးသားပြမှာဖြစ်ပါတယ်။
Route ကို Setting ချတဲ့အခါ Apache Server မှ Rewrite လုပ်ပြီး url ကိုယူလို့ရသလို PHP ရဲ့ Super Global Variable ဖြစ်တဲ့ $_Server မှ Request URI မှတစ်တင့်ရယူလို့ရပေမဲ့ Secure မဖြစ်တဲ့အတွက်ခု Article မှာဖော်ပြမှာမဟုတ်ပါဘူး။
ပထမဆုံး အောက်ပါအတိုင်းဖိုင်တွေကိုတည်ဆောက်ပါ။

```
/
Index.php
Home.php
Post.php
.htaccess
```

၎င်းနောက် . htaccess ဖိုင်မှာအောက်ပါ Command တွေကိုရေးသားရမှာဖြစ်ပါတယ်။
Apache ရဲ့Rule တွေကို Rewrite ဖို့အတွက် Apache ရဲ့ httpd.conf ဖိုင်မှာ Rewrite Rule Module ကို Comment (`#`) လေးကိုဖြုတ်ထားပါ။
(httpd.conf Path က OS နဲ့  အသုံးပြုတဲ့ Application တွေနဲ့ကွာခြားမှုရှိတာကြောင့် ကိုယ့်ဘာသာ Google မှာရှာလိုက်ပါ။)

```
#.htaccess
<IfModule mod_rewrite.c>
RewriteEngine On
OPTIONS -Multiviews
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
```

`IfModule` က `Rewrite` ဖို့ `Module` ရှိမရှိစစ်တာပါ။ mod_rewrite.c ဖိုင်မရှိရင် 500 Internal Serve Error တက်ပါမယ်။
ပြီးနောက် `Rewrite Engine On` ပြီးနောက်မှာ -Multiviews နဲ့ index.php ဖိုင်ကို url မှာရိုက်ရင် index ပဲပြစေဖို့ ကန့်သတ်ပါတယ်။
ထို့နောက် Condition ကိုစစ်ဖို့လိုပါတယ်။
Condition ကိုစစ်ရတာက Request လုပ်တဲ့ url က ဖိုင်တစ်ဖိုင်ဖိုင်ရဲ့ နာမည် (သို့မဟုတ်) Directory ဖြစ်နေရင် အဲ့မှာရှိတဲ့ဖိုင်ကိုဖော်ပြပါလို့ပြောခြင်းဖြစ်ပါတယ်။
```
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
```

နောက်ဆုံးတစ်ကြောင်းက  URL ကိုယူမဲ့နေရာကိုသတ်မှတ်ပေးတာပါ
။

```
^(.+)$
```

URL အစအဆုံးမှာရှိတဲ့ Query String တွေကိုတစ်ခုထက်ပိုတာနဲ့ယူမယ်။
( Regular Expression စစ်တာနဲ့ဆင်ပါတယ်။)
Index.php?url=$1
Index.php ဖိုင်နောက်မှာရှိတဲ့ String တွေကို url အဖြစ်သတ်မှတ်ပေးလိုက်ပါတယ်။
[QSA,L] က Query String တွေကို Append လုပ်ပြီး ယူမယ်ပြောတာဖြစ်ပါတယ်။ L က‌ နောက်ဆုံး Command ဖြစ်ပါတယ်လို့ပြောတာဖြစ်ပါတယ်။
. htaccess ဖိုင်ကို index.php ရှိတဲ့နေရာမှာRoot Level နဲ့ထားရမှာဖြစ်ပါတယ်။

Index.php မှာ `BaseController` အတွက်ရေးသားမှာပါ။
လောလောဆယ် index လို့ပဲ အသုံးပြုရလွယ်အောင်ပေးထားတာဖြစ်ပါတယ်။
Index ဖိုင်မှာ url ကို အပိုင်းပိုင်းခွဲပြီးအလုပ်လုပ်မှာဖြစ်ပါတယ်။
ဉပမာ -

```
FROM
www.example.com/index.php?className/methodName/1/2/3
TO www.example.com/className/methodName/1/2/3
```

ပုံစံကိုပိုင်းပြီးလိုတာတွေကို သာယူသုံးသွားမှာဖြစ်ပါတယ်။
ဒီ့အတွက် . htaccess ဖိုင်မှာ Module Rewrite ရခြင်းဖြစ်ပါတယ်။
Module Rewrite တဲ့အထဲမှာအောက်ဆူံအကြောင်းက
```
index.php?url=$1
```
သည်

```
www.eg.com/class/method/params
```

ပုံစံဖြစ်သွားမှာပါ။
ဒါ့ကြောင့် url ကို main target ထားပြီးသုံးသွားမှာဖြစ်ပါတယ်။
ပထမဆုံး index.php ဖိုင်မှာ
Default className methodName တွေကိုကြေညာထားပါမယ်။

```
//index.php
$class_name = "Home";
$method_name = "index";
$params = [];
```

ထို့နောက် Module Rewrite ခဲ့တဲ့
url ကို get method နဲ့ယူပြီးအသုံးပြုမှာဖြစ်ပါတယ်။

```
//index.php
$class_name = “Home”;
$method_name = “index”;
$params = [];
// Get URL
$url = isset($_GET[‘url’]) ? rtrim($_GET[‘url’],’/’) : “”;
$url = explode(‘/’,$url);
```

ပထမဆုံး url ရှိမရှိ isset နဲ့စစ်ပြီး true ပြန်လာတဲ့အခါ get method နဲ့ယူထားတဲ့ url ကိုယူပြီးတော့ right trim လိုက်ပါတယ်။
Rtrim ရတာ က user က route မှာ
/className/method////
ဆိုပြီး /// သုံးခုဖြစ်နေတာကို ဖျက်ထုတ်လိုက်တာပါ။
ပြီးနောက် array format ပြောင်းပါမယ်။
Array format ပြောင်းဖို့အတွက် explode နဲ့ခွဲထုတ်လိုက်ပါတယ်။
Explode နဲ့ခွဲတဲ့အခါ `/` သုံးပြီးခွဲရတာက url ကို user က /home/show/
ဆိုပြီး `/` သုံးရေးတဲ့အခါ `/` သုံးပြီး ဖြတ်လိုက်တာဖြစ်ပါတယ်။
$url ကို print_r နဲ့ကြည့်လျှင်

```
Array
(
[0] => home
[1] => post
[2] => 1
[3] => 2
[4] => 3
)
```

ဆိုပြီးမြင်ရမှာပါ။
Index 0 သည် classNameအဖြစ်သတ်မှတ်မှာဖြစ်ပါတယ်။
Index 1 ကိုတော့ method name အဖြစ်သတ်မှတ်လိုက်မှာပါ။
ကျန်တာကိုတော့ params အဖြစ် array အဖြစ်သတ်မှတ်မှာဖြစ်ပါတယ်။

```
// index.php
if(!empty($url[0])){

if(file_exists(ucfirst($url[0])).".php"){
$class_name = ucfirst($url[0]);
unset($url[0]);
}

}
require_once $class_name.".php";
new $class_name;
```

အထက်မှာစစ်ခဲ့တဲ့ URL ကို array ပြောင်းထားတာဖြစ်တဲ့အတွက်လွယ်လွယ်ကူကူ ယူသုံးလို့ရမှာဖြစ်ပါတယ်။
URL ရဲ့ index 0 သည် empty မဖြစ်တဲ့အခါ file ရှိမရှိစစ်ပါတယ်။
File exist ဖြစ်ရင် အပေါ်မှာသတ်မှတ်ခဲ့တဲ့ url index 0 ကို $classname အဖြစ်သတ်မှတ်လိုက်ပါတယ်။
ထို့နောက် unset လုပ်လိုက်ပါတယ်။
ဒီ့အတွက် url index 0 ကပြုတ်သွားပါတယ်။
(နောက်ပိုင်းကြရင် paramsပဲ ယူချင်လို့ဖြစိပါတယ်။)
ထို့နောက် className ကို ဖိုင်နာမည်အဖြစ်သတ်မှတ်ပေးလိုက်ပြီးတော့ Require လုပ်လိုက်ပါတယ်။
ဖိုင်ကို Require ပြီးတဲ့အခါ Class ကို Invoke လုပ်လိုက်ပါတယ်။
Class ကို invoke ပြီးမှသာ url index 1 မှာရှိတဲ့ method name ကို invoke လုပ်တဲ့ class မှာရှိမရှိစစ်ပါမယ်။

```
if(!empty($url[1])){
if(method_exists($class_name,strtolower($url[1]))){
$method_name = strtolower($url[1]);
unset($url[1]);
}
}
```

url index 1 empty မဖြစ်တဲ့အခါ။
Method exist ဖြစ်မဖြစ်ရပါတယ်။method name ရှိတဲ့အခါ url index 1 ကို method name အဖြစ်သတ်မှတ်လိုက်ပါတယ်။
$methodname ကို override လုပ်ပေးသွားမှာဖြစ်ပါတယ်။
Method ပြီးရင် params တွေကိုယူမှာဖြစ်လို့အောက်ပါအတိုင်းဆက်ရေးရပါမယ်။
```
$params = array_values($url) ?? [];
```
Params တွေကို ယူတဲ့အခါ array value သုံးရတာက အထက်မှာ unset ခဲ့တဲ့ index 0 and 1 ကို ဖြုတ်တဲ့အခါ $url ကို print_r ထုတ်ကြည့်ပါက

```
Array
(
[2] => 1
[3] => 2
[4] => 3
)
```

ဒီ့အတွက် array value သုံးပြီး index 0 ကနေပြန်စစေတာဖြစ်ပါတယ်။
ထို့မှသာသုံးရလွယ်စေမှာပါ။

```
Array
(
[0] => 1
[1] => 2
[2] => 3
)
```

ပြီးနောက် URL ကနေသုံးရင်ခေါ်စေဖို့

```
call_user_func_array([$class_name,$method_name],$params);
```

ကိုသုံးပြီးခေါ်လိုပါတယ်။
Web URL မှာ

```
localhost:8080/MVC/home/show/1/2/3
```

လို့ခေါ်လိုက်တဲ့အခါ blank ပဲမြင်ရမှာပါ။
ဘာလို့ဆိုသက်ဆိုင်ရာ class နဲ့ ဖိုင်တွေမရှိသေစလို့ဖြစ်ပါတယ်။
ထို့အတွက်အောက်ပါအတိုင်းဖိုင်နှစ်ဖိုင်တည်တောက်ပါမယ်။

```
//Home. Php
<?php
/**
*
*/
class Home
{

/**
*
*/
public function __construct()
{
echo "I am".__CLASS__;
}
public function show(){
echo "<br>I am show method of ".__CLASS__;
}
public function index(){
echo "<br>I am index method of ".__CLASS__;
}

}
```
```
// Post.php
<?php
/**
*
*/
class Post
{

/**
*
*/
public function __construct()
{
echo "I am".__CLASS__;
}
public function show(){
echo "<br>I am show method of ".__CLASS__;
}
}
````

URL ပြန်ခေါ်ကြည့်ပါ။ class name method မရှိတဲ့အခါ HOME ကို default ဖော်ပြမှာဖြစ်ပါတယ်။
ယခု အပိုင်းမှာ Route ကို Setup လုပ်ပြီးပါပြီ။နောက်တစ်ခုမှာ OOP အဖြစ်ပြန် Apply မှာဖြစ်ပါတယ်။
(ယခု Article မှာ Function name အကုန်မရှင်းရတာက Basic ရပြီးသားလို့မှတ်ယူထားလို့ဖြစ်ပါတယ်။
နောက် `Article` မှာတွေ့ရအောင်။

```
Nov 27 Tue
[COVID-LAZY]
```
