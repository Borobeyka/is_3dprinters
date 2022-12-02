# Интернет-магазин комплектующих для 3D принтеров

> Данный проект является дипломной работой (выпускной) на 4 курсе обучения в 	Колледже информационных технологий при РТУ МИРЭА (2020 год).
> Работа защищена на **отлично**.

#### ✔️ Основой для создания сайта служит собственный "движок", разработанный собственноручно под нужды конкретно данного проекта.

#### ✔️Для отображения каждой страницы на сайте был предусмотрен маршрут, его обработчик и шаблон страницы, которая содержит непосредственно HTML разметку. *Пример маршрутов приведен ниже:*
```php
[
    "path" => "/^(\/)?$/",
    "template" => "index",
    "action" => "index",
    "title" => "Интернет-магазин комплектующих для 3D принтеров | 3dp-comp.ru"
],
[
    "path" => "/^catalog\/[a-z]{1,32}(\?[a-z0-9=]{1,32})?(\/)?$/",
    "template" => "catalog",
    "action" => "show_category",
    "title" => ""
],
[
    "path" => "/^item\/[0-9]{1,32}(\/)?$/",
    "template" => "item",
    "action" => "index",
    "title" => ""
],
[
    "path" => "/^order\/[0-9]{1,16}(\/)?$/",
    "template" => "order",
    "action" => "index",
    "title" => ""
]
```

#### ✔️ В данном интернет-магазине предусмотрено разделение прав доступа. Существует две роли пользователей - администратор и покупатель. Администратор в праве редактировать, добавлять товары в каталог. Просматривать, изменять статусы заказов, в соответствии с фактическим его состоянием, то есть как бы это было в реальном магазине. Также клиент в свою очередь, может следить за своим заказом.
#### ✔️ Если авторизованный на сайте пользователь, является администратором - наверху каждой страницы отображается, так называемая админ-панель, с наиболее частыми операциями (*см. скриншоты ниже*).

#### 💻 *Ниже представлены скриншоты интернет-магазина*

![1](https://user-images.githubusercontent.com/47686912/205401108-3eda5123-68fa-4309-ac8d-7a185e59cd00.jpg)
![2](https://user-images.githubusercontent.com/47686912/205401110-70737a3c-9823-4382-bc02-e04b9513fe41.jpg)
![3](https://user-images.githubusercontent.com/47686912/205401114-40f216e4-feed-4240-a5bd-5e7e894ce729.jpg)
![4](https://user-images.githubusercontent.com/47686912/205401116-ef732a85-9c5e-4c13-8f52-ecd68c2bf981.jpg)
![5](https://user-images.githubusercontent.com/47686912/205401117-84cc418e-0907-4719-9935-198d8bf73bd2.jpg)
![6](https://user-images.githubusercontent.com/47686912/205401118-24312119-bef5-4874-a84d-dd01dd055c34.jpg)
![7](https://user-images.githubusercontent.com/47686912/205401119-acc5f1fe-8805-48cc-b93c-f386fe3c9b75.jpg)
![8](https://user-images.githubusercontent.com/47686912/205401122-109c1d76-4e54-4b3b-9cfb-e1f6265a5263.jpg)
![9](https://user-images.githubusercontent.com/47686912/205401123-9a248e6c-c85a-4820-adc5-ebe54419114b.jpg)
![10](https://user-images.githubusercontent.com/47686912/205401125-68f33c94-876a-4618-86d8-100ab8849e7e.jpg)
![11](https://user-images.githubusercontent.com/47686912/205401126-cfaad2db-16b9-4f26-b177-27f3f109f009.jpg)
![12](https://user-images.githubusercontent.com/47686912/205401060-261e3af1-88ba-48ec-a7f4-6a0a94042da5.jpg)
![13](https://user-images.githubusercontent.com/47686912/205401062-38f5d1f1-f9e9-40b8-9e97-f4d9367fbfc4.jpg)
![14](https://user-images.githubusercontent.com/47686912/205401063-fbcb12d2-4ad9-427f-8638-484f37160a22.jpg)
![15](https://user-images.githubusercontent.com/47686912/205401066-ba73c664-781b-470f-97d6-a71c853f8313.jpg)
![16](https://user-images.githubusercontent.com/47686912/205401068-8a5112fc-65f8-4620-8463-7dbd349458e1.jpg)
![17](https://user-images.githubusercontent.com/47686912/205401070-6c3971f7-abf8-470d-9f87-cf60137c97a7.jpg)
![18](https://user-images.githubusercontent.com/47686912/205401072-bed1afed-541a-49c6-b46f-974151ee7b60.jpg)
![19](https://user-images.githubusercontent.com/47686912/205401073-2824d99e-7eac-4a37-bfe8-ffaa417498bf.jpg)
![20](https://user-images.githubusercontent.com/47686912/205401075-fecbd7a8-c8c2-4afd-8913-ec8672fc81a1.jpg)
![21](https://user-images.githubusercontent.com/47686912/205401082-ba6db836-c212-4dbf-801e-d15186082a15.jpg)
![22](https://user-images.githubusercontent.com/47686912/205401085-9e2b5f06-6d12-46d1-b739-4e04eccc2430.jpg)
![23](https://user-images.githubusercontent.com/47686912/205401089-3034423d-4a72-461a-a3d4-8b6b9e06e8af.jpg)
![24](https://user-images.githubusercontent.com/47686912/205401092-077b61cc-f750-4e45-9944-5db717c1d215.jpg)
![25](https://user-images.githubusercontent.com/47686912/205401094-cffbaa92-1fb1-4fc1-b061-21cd0d55a03f.jpg)
![26](https://user-images.githubusercontent.com/47686912/205401096-a8667e98-f7c8-4465-95ac-0789689d9f1b.jpg)
![27](https://user-images.githubusercontent.com/47686912/205401097-ffdc2e2a-9f57-448a-93f5-044a897cad75.jpg)
![28](https://user-images.githubusercontent.com/47686912/205401100-aa1fa85a-05bc-4808-8cf2-37eb2be9e075.jpg)
![29](https://user-images.githubusercontent.com/47686912/205401101-ac603a6f-2447-4ccb-9c2a-871091ab4748.jpg)
