<div dir="rtl">

# فالو و آنفالو فالوئینگ‌های یک پیج اینستاگرام

راستش ایده اولیه از پیج [didogram.event](https://www.instagram.com/didogram.event/) به ذهنم رسید، یه سری قرعه کشی داره که شرط شرکت در قرعه کشی، فالو کردن 99 تا فالوئینگهاشه.
منم به ذهنم رسید یه برنامه بنویسیم که ضمن فالو کردن خودکار اونها، بعد از تموم شدن قرعه کشی، همه پیج های فالو شده رو آنفالو کنه! (چقدر نامرد! :sweat_smile:)
چالشی که هست اینه که ممکنه بلافاصله بعد از قرعه کشی، اون پیج همه فالوئینگ هاشو آنفالو کنه و دیگه ما ندونیم کدوما رو فالو کرده بودیم و بمونیم با صد تا پیج احتمالاً بیخود :wink: که برای حل این مشکل، هر پیجی که فالو میشه رو در یک فایل ذخیره میکنیم.
چالش دیگر اینه که شاید ما پیجی رو که جزو فالوئینگ هاست رو از قبل فالو کردیم و نمیخوایم بعد از عملیات آنفلو اونها رو از دست بدیم. پس لازمه که اگر پیجی از قبل فالو داشتیم رو مد نظر قرار نده.
همه داستان همینه.
البته شاید کاربردهای دیگری هم داشته باشه مثلاً یک سری پیج رو اینطوری فالو میکنه، بعد از اینکه فالوبک گرفتید، همونا رو آنفالو میکنه بدون اینکه فالورای قبلیتون آنفالو بشن. (من چقدر پلیدم!:smiling_imp:)
یا حتی با کلون گرفتن و کمی تغییر در سورس برنامه برای مقاصد دیگری بتونید ازش استفاده کنید.
در ضمن بیشتر تجربه کدنویسی روی api اینستاگرام و جنبه آموزشی این پروژه برام جذاب بود وگرنه اصل سناریو شاید چندان هم کاربردی نباشه.

## نیازمندی‌ها
<div dir=ltr>

* PHP >= 5.6
* composer
<div dir=rtl>

## روش نصب
بعد از دانلود پروژه، در مسیر برنامه، دستور زیر را وارد کنید:
<div dir=ltr>

```
composer install
```
<div dir=rtl>

سپس فایل `config.php` رو باز کنید و یوزر و پسورد اینستای خود و پیج هدف رو توش تعریف کنید:
<div dir=ltr>

```
$username = 'YOUR_USERNAME';
$password = 'YOUR_PASSWORD';
$target_page = 'didogram.event';
```
<div dir=rtl>

## روش استفاده
<div dir=ltr>

```
   php follow.php [OPTIONS]
```
<div dir=rtl>

## گزینه‌ها
<div dir=ltr>

```
   a = action (Values: follow,unfollow) (Required)
```
<div dir=rtl>

## مثال‌ها
<div dir=ltr>

```
   php follow.php a=follow
   php follow.php a=unfollow
```
<div dir=rtl>

## نمونه خروجی
<div dir=ltr>

```
C:\wamp\www\Follow-Following-Instagram>php follow.php a=follow
Follow Following Instagram - Version 0.1.0
By: Nabi KaramAliZadeh <www.nabi.ir> <nabikaz@gmail.com>
Project: https://github.com/NabiKAZ/Follow-Following-Instagram
Copyright 2020 - License GNU GPL v3.0
==============================================================

Getting self (nabikaz) following...
.
Found 60 users.

Starting follow following of target page (didogram.event)...
Page #1
3405890655  : saburi_ali                Following...Done.
1597579105  : kamy_hi                   Followed.
27398833536 : didogram.academy          Following...Done.

Followed count: 1
New following count: 2
```
<div dir=rtl>

## مجوزها
این پروژه تحت لایسنس GNU GPL v3.0 قرار داره.

## حمایت
* در صورتی که از این برنامه راضی بودید، لطفاً با دادن یک ستاره (:star:) (از بخش بالای سایت) من را خوشحال کنید! :wink:

* این یک پروژه تجاری نیست و سود مادی برای من ندارد و به صورت دلی:heart: انجام می‌شود. اما می‌دانید که برنامه‌نویسی کار خیلی وقت‌گیر و پر زحمتی است. اگر این پروژه برای شما مفید بود و دلتان خواست، لطفاً برای دلگرمی من می‌توانید هر مبلغی که مایل بودید هر چند ناچیز به صورت هدیه واریز کنید تا تبدیل به انرژی شود برای ادامه راه، بهبود، توسعه و رفع اشکالات احتمالی این پروژه در آینده.<br>
جهت پرداخت آنلاین از لینک زیر استفاده کنید و لطفاً حتماً در توضیحات آن، نام این پروژه را ذکر کنید:<br>
[https://zarinp.al/nabikaz](https://zarinp.al/nabikaz)<br>
همیشه از لطف شما سپاسگزارم :sweat_smile::rose:
