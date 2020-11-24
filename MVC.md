
# Model View Controllers
ပထမပိုင်းမှာ အရေးအကြီးဆုံးဖြစ်တဲ့ Route ကို နေရာချပြီးဖြစ်ပါတယ်။
တကယ်တော့ Controller ကိုပါနေရာတစ်ခါတည်းချထားခြင်းဖြစ်ပါတယ်။
ယခု OOP Flow အတိုင်းသွားမှာပါ။
ပထမဦးဆုံး File Structure ချပါမယ်။

## Prerequisites

https://github.com/amm834/Articles/blob/main/Routing.md

```

/

|-- app/
controllers/
core/
-> Core.php
models/
views/

|--public/
index.php

```

`/app/core/core.php` ဖိုင်ကိုအောက်ပါအတိုင်းပြင်ပါမယ်။

```
<?php

/**
* Core PHP Route
*/
class Core
{
private $class_name="Home";
private $method_name="index";
private $params=[];

public function __construct() {
$this->getRoute();
}
public function getRoute() {

// Root Path Of Project
$path=realpath(__DIR__.'/../../');
$url=isset($_GET['url']) ? rtrim($_GET['url'], '/') : "";
$url=explode('/', $url);
if (!empty($url[0])) {
if (file_exists($path.'/app/controllers/'.ucfirst($url[0]).'.php')) {
$this->class_name=ucfirst($url[0]);
unset($url[0]);
}
}
require_once $path.'/app/controllers/'.$this->class_name.".php";

//  $this->class_name=new $this->class_name;

if (!empty($url[1])) {
if (method_exists($this->class_name, strtolower($url[1]))) {
$this->method_name=strtolower($url[1]);
unset($url[1]);
}
}
$this->params=array_values($url) ?? [];
call_user_func_array([new $this->class_name, $this->method_name], $this->params);
}
}
```

getUrl method အတွင်းမှ Codes များသည် ပထမဆုံးရေးခဲ့တဲ့ `index.php` မှ Code တွေဖြသ်ပါတယ်။

`className methodName` များကို private ကြေညာပြီးတော့ global Access ထားလိုက်ပါတယ်။
၎င်းကို
`Get URL` မှ ယူပြီးသုံးပါတယ်။
Default အနေနဲ့အသူံပြုခြင်းဖြစ်ပါတယ်။
Class name,method name များရှေု့တွင် private ကြေညာထားသော className methodName များကို this keyword နဲ့access လုပ်ပြီးယူသုံးပါတယ်။
(OOP အခြေခံရထားမယ်လို့ထင်ပါတယ်။)

ထို့နောက်
`/app/controllers/`` ထဲတွင် `Home.php` ဖိုင်တည်ဆောက်ပါ။
၎င်းသည်
`app/core/ BaseController.php` ကို extendလုပ်သုံးမှာဖြစ်ပါတယ်။
Base controller မဆောက်ခင် Child Controller ကိုအရင်ဆောက်ထားတဲ့သဘောပါ။


app/controllers/Home.php
```
<?php

/**
* Home Controller @default
* @extends app/libs/BaseController.php
*/
class Home extends BaseController
{

/**
*@default index
*/
public function index() {

}

}
```

Index method ကမပါလို့မရပါဘူး။
ပြီးတော့ Class name နဲ့ ဖိုင်နာမည်တူရပါမယ်။
Autoloading ကို className နဲ့Autoloadမှာမို့လို့ဖြ်စပါတယ်။
ယခု Basecontroller တည်ဆောက်ပါမယ်။

/app/core/BaseController.php

```
<?php
/**
* @BaseController extends this from all child controllers
* */
class BaseController
{
// Not Allow To Override From Other Class
final protected function view($file,$data=[]) {
$path=realpath(__DIR__.'/../../');
require_once $path.'/app/views/'.$file.'.php';
}
final protected function model($model) {
$path=realpath(__DIR__.'/../../');
require_once $path.'/app/models/'.ucfirst($model).'.php';
return new $model;
}
}
```

`Base Controller` ထဲမှာ Method နှစ်ခုကိုတွေ့ရမယ်။
View method က Child Controller မှ View ကိုခေါ်သုံးတဲ့အခါ View File ကို Userကိုပြပေးဖို့ဖြစ်ပါတယ်။
Normal အတိုင်း Html သုံးရင်ပင်ပန်းပါတယ်။
Blade Template သုံးရင်ပိုပြီးတော့ထိရောက်ပါတယ်။
ယခု Article က Composer မသုံးထားပဲ Pure ပဲသုံးထားပါတယ်။
View Method ကို Child Class ကနေသုံးတဲ့အခါ အပေါ်မှာ Home က BaseController ကို extends ထားတဲ့အတွက် `$this->view()` ဟုခေါ်သုံးနိုင်မှာဖြစ်ပါတယ်။
Model Method ကတော့ Models directory ထဲမှ Model Class များကို အလိုအလျောက်ခေါ်ပေးရန် သုံးတာဖြစ်ပါတယ်။
Code ရဲ့ Function တွေကလွယ်တာတွေကိုသုံးပေးထားတဲ့အတွက် Google မှာရှာပါ။
real path က App root အတွက် path ယူပြီးတော့
Require တဲ့အခါ အလွယ်ယူသုံးလို့ရဖို့ဖြစ်ပါတယ်။
ထို့နောက် app/views/ ထဲတွင် Home.php ဆိုတဲ့ Template တစ်ခြတည်တောက်ပါ။

```
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Home</title>
</head>
<body>
<h1>Home Page</h1>
</body>
</html>
```

ထို့နော`က် app/controllers/`
Home Controller တွင်အောက်ပါအတိုင်း Template တွေကို Show ပေးရပါမယ်။

```
<?php

/**
* Home Controller @default
* * @extends app/libs/BaseController.php
*/
*class Home extends BaseController
*{
/**
*@default index
*  */
public function index() {
$data['names']=['Aung Myat Moe','Noose Si'];
$this->view('Home',$data);
}
}
```

`index method`ကdefault ဖြစ်လို့ Website အဝင်မှာ ယခု View Template ကိုပြပေးမှာပါ။

base Controller ကို extend လုပ်ထားတဲ့အတွက် သူ့အထဲက view method ကို home child class ကသုံးလို့ရသွားပါတယ်။
Data array အဖြစ်` views/Home.php` ကို ပို့ပေးလိုက်ပါတယ်။
$data ကို view/Home ကနေပြပေးရမှာပါ။

views/Home.phpမှာအောက်ပါအတိုင်းပြင်င်ေပါမယ်။

```
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Home</title>
</head>
<body>
<h1>Home Page</h1>
<ul>
<?php foreach($data['names'] as $name): ?>
<li><?php echo $name; ?></li>
<?php endforeach; ?>
</ul>
</body>
</html>
```

တစ်ဖက်မှလာတဲ့ $data array ကို Loop ပတ်ပြီးဖော်ပြပေးလိုက်တာဖြစ်ပါတယ်။
Basic level မို့ MVC ကိုလေ့လာနေတဲ့သူတစ်ယောက်ကို Detail ရှင်းပြစရာလိုမယ်လို့မထင်ပါဘူး။
ကျွန်တော်တို့ App ကို Controller နဲ့ View ဖိုင်ကို Setup လုပ်ပြီးသော်လည်း file တွေကို autoloadလုပ်မပေးရသေးပါဘူး။
ဒီ့အတွက်
```
Public/index.php
```
မှာ` app/bootstrap.ph`pကို boot ပေးထားပါ။

```
<?php
require_once '../app/bootstart.php';

ပြီးနောက်
Public/.htaccess ဖိုင်မှာ

<IfModule mod_rewrite.c>
RewriteEngine On
OPTIONS -Multiviews
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
```

ထို့နောက်
App/bootstart.php
မှာ
အောက်ပါအတိုင်း‌ autoloading လုပ်ပေးရပါမယ်။

```
<?php
ob_start();// Start Output Buffering To Prevent Session And Cookies Conflicts
session_start();

// Get Root Of Project Path
define("URL_ROOT",realpath(__DIR__.'/../'));

// Autoload File By ClassName
spl_autoload_register(function ($className){
require_once URL_ROOT.'/app/core/'.$className.'.php';
});
// Invoke Class Core
new Core();
```

`Ob start` က Header နဲ့ Cookies တွေ Conflict မဖြစ်အောင်ကြိုရှင်းထားတာပါ။
[
Header already exist bla bla မတက်တော့ပါဘူး။
]
Session ကတော့ နောက်ပိုင်း Login User setup ဖို့တစ်ခါတည်းကည်ုကြေညာပေးထားတာဖြသ်ပါတယ်။

`Autoload register Function `က closure တစ်ခု ပေးပါတယ်။ အဲ့ closure က className တွေထုတ်ပေးပါတယ်။
သူ့ကိုသုံးပြီး
App/core/ ထဲကဖိုင်တေွအကုန် auto require ပေးလိုက်ပါတယ်။
Require ပြီးနောက် new Core ဆိုပြီး app/core/Core.php ကို invoke ပေးလိုက်ပါတယ်။
ခုဆိုရင် ကွိန်တော်တို့Appကစအလုပ်လုပ်နေပါပြီ။
Browser မှာ Run ကြည့်ပါက Home Page ဆိုပြီး H1 နဲ့မြင်ရမှာပါ။ယခု Model တစ်ခုတည်တောက်ပါမယ်။
မတည်ဆောက်ခင် DB ကို app/core/DB.php ဖိုင်တည်ဆောက်ပါ။
ပြီးနောက် အောက်ပါအတိုင်းလိုအပ်သော Connection တွေကို ချိတ်ပါမယ်။

```
<?php
class DB {
private $dbh;
private $stmt;
private $hostName='localhost';
private $userName='root';
private $userPass='';
private $dbName='ecommerence';
function __construct() {
try {
$this->dbh=new PDO("mysql:host=".$this->hostName.";dbname=".$this->dbName, $this->userName, $this->userPass);
// Catch Db Error
$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e) {
echo $e->getMessage();
}
}
// Insert Query and Prepare with statement
function query($qry) {
$this->stmt=$this->dbh->prepare($qry);
}
function execute() {
return $this->stmt->execute();
}
function multiSet() {
$this->execute();
return $this->stmt->fetchAll(PDO::FETCH_OBJ);
}
}


?>

```

[
Note ယခု ပုံစံအတိုင်းမသုံးသင့်ပါဘူး။
Eloquent Query တစ်ခုတည်တောက်ပြီးသုံးရမှာပါ။
ကျွန်တော်က Model က ဉပမာပြရေးဖို့သုံးတာဖြစ်ပါတယ်။
]

Query နဲ့ Multiset method ကို Model ကနေယူသုံးမှာဖြစ်ပါတယ်။

`App/models/postmodel.php` မှာအောက်ပါအတိုင်း DB ကိုသူံရပါတယ်။

```
<?php

/**
* Post Model
*/
class PostModel extends DB
{
public function getUsers(){
$this->query("select * from users");
return $this->multiSet();
}
}

ဒီ Model ကို app/controllers/post.php
ကနေယူသုံးမှာပါ။

<?php

class Post extends BaseController
{

public function index() {
$db=$this->model("PostModel");
$data['users']=$db->getUsers();
$this->view('Post',$data);
}

}
```

Post model က Return ပြန်လာတဲ့ Data တွေကို Post template မှာဖော်ပြလိုက်ပါတယ်။
သတိပြုရမှာက Model သည် DB ကို extend လုပ်ထားလို့ DB ထဲက Method တွေကိုယူသုံးလို့ရတာဖြစ်ပါတယ်။

ယခု Post Model မှရတဲ့ Data တွေကို Post Template မှာအောက်ပါအတိုင်းပြပါမယ်။

```
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Post</title>
</head>
<body>
<h1>Post Page</h1>
<?php
foreach ($data['users'] as $user){
echo $user->name.'<br>';
}
?>
</body>
</html>
```

ယခု Article မှာမရှင်းရင် Code တွေကိုစမ်းကြည့်ပါ။
အလွန်ကိုလွယ်ပါတယ်။
Logic ရရင် ရပါတယ်။
Code ကကိုယ့်ဘာသာချဲ့ရေးသွားပါ။
နောက် Article တွေမှာ Concept တွေကိုပဲတွေ့သွားဖို့ရှိပါတယ်။
Thanks for reading.

- Source Code
https://github.com/amm834/Articles/tree/main/MVC%20PHP


`Web,25 Nov,2:58 AM`
