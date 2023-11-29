<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bot;
use App\Models\Branch;
use App\Models\BranchTransaction;
use App\Models\Brand;
use App\Models\Order;
use App\Models\ControlUser;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;
use GuzzleHttp;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const API_ACCESS_KEY = "AAAAmI_WKtU:APA91bF5yR0P0skvVBfXejbeeyAR8rqPeEyTS6TdlI_2Tcy--jWWu1rpoHHb6Hz2fwj5Dg9hqOUTASkvBxJ7LD00Jlv29b98cAOvxvwzZODn4sz-18Z1lxClBMdSADZFkvyLwdWY2fVR";
    const BOT_TOKEN = '6097681279:AAE8wpKF7lFuUQAnNv8z4ReTHIR1a2tWuHQ';
    const MAIN_BOT_TOKEN = '6263208402:AAFB9DQIOlBEz3N4tpckRJqDRbS-Npzsst8';

    const BOT_BASE_URL = 'https://expressfood.uz/botexpressfood/';
    const BASE_URL = 'https://expressfood.uz/';
    const BRAND_BASE_URL = 'http://brand.expressfood.uz/';
    const CLIENT_BASE_URL = 'http://client.expressfood.uz/';
    const SOCKET_BASE_URL = 'http://socket.expressfood.uz:4006/';

//    errors
    const AD_MESSAGE = [
        'uz' => "E'lon mavjud emas!",
        'ru' => "Нет доступных объявлений!",
        'en' => "No ad available!",
    ];
    const USER_NOT_MESSAGE = [
        'uz' => "Brend mavjud emas!",
        'ru' => "Марка не существует!",
        'en' => "Brand does not exist!",
    ];
    const USER_NOT_ALLOW_MESSAGE = [
        'uz' => "Ruxsat berilmagan brend!",
        'ru' => "Неавторизованный бренд!",
        'en' => "Unauthorized brand!",
    ];
    const ADD_ADDRESS_MESSAGE = [
        'uz' => "Manzil qo'shildi!",
        'ru' => "Адрес добавлен!",
        'en' => "Address added!",
    ];
    const NOT_ADDRESS_MESSAGE = [
        'uz' => "Manzilni kiriting!",
        'ru' => "Введите адрес!",
        'en' => "Enter the address!",
    ];
    const UPDATE_ADDRESS_MESSAGE = [
        'uz' => "Manzil o'zgartirildi!",
        'ru' => "Адрес изменен!",
        'en' => "The address has been changed!",
    ];
    const DELETE_ADDRESS_MESSAGE = [
        'uz' => "Manzil o'chirilidi!",
        'ru' => "Адрес удален!",
        'en' => "Address removed!",
    ];
    const NOT_PRODUCT_MESSAGE = [
        'uz' => "Mahsulot mavjud emas!",
        'ru' => "Товар недоступен!",
        'en' => "Product not available!",
    ];
    const ADD_PRODUCT_FAVORTE_MESSAGE = [
        'uz' => "Mahsulot sevimlilarga qo'shildi!",
        'ru' => "Товар добавлен в избранное!",
        'en' => "Product added to favorites!",
    ];
    const DELETE_PRODUCT_FAVORTE_MESSAGE = [
        'uz' => "Mahsulot sevimlilardan olib tashlandi!",
        'ru' => "Товар удален из избранного!",
        'en' => "Product removed from favorites!",
    ];
    const NOT_NEWS_MESSAGE = [
        'uz' => "Yangilik mavjud emas!",
        'ru' => "Новость недоступна!",
        'en' => "News is not available!",
    ];
    const NOT_OFFER_MESSAGE = [
        'uz' => "Taklif mavjud emas!",
        'ru' => "Предложение недоступно!",
        'en' => "Offer not available!",
    ];
    const STOP_ORDER_MESSAGE = [
        'uz' => "Buyurtma olish to'htatilgan!",
        'ru' => "Заказ приостановлен!",
        'en' => "Ordering is suspended!",
    ];
    const STOP_PAY_CARD_MESSAGE = [
        'uz' => "Bank kartasi orqali to'lov to'htatilgan!",
        'ru' => "Оплата банковской картой приостановлена!",
        'en' => "Payment by bank card is suspended!",
    ];
    const STOP_PAY_BANK_MESSAGE = [
        'uz' => "Bank orqali to'lov to'htatilgan!",
        'ru' => "Банковский платеж приостановлен!",
        'en' => "Bank payment is suspended!",
    ];
    const HIGH_CASHBACK_MESSAGE = [
        'uz' => "Keshbek juda baland kiritildi!",
        'ru' => "Кэшбэк очень высокий!",
        'en' => "Cashback is very high!",
    ];
    const NOT_IN_STOCK_MESSAGE = [
        'uz' => "omborda mavjud emas!",
        'ru' => "нет в наличии!",
        'en' => "out of stock!",
    ];
    const CALC_ORDER_MESSAGE = [
        'uz' => "Buyurtma hisoblandi!",
        'ru' => "Заказ рассчитан!",
        'en' => "The order has been calculated!",
    ];
    const SAVE_ORDER_MESSAGE = [
        'uz' => "Buyurtma saqlandi!",
        'ru' => "Заказ сохранен!",
        'en' => "Order saved!",
    ];
    const NOT_ORDER_MESSAGE = [
        'uz' => "Buyurtma mavjud emas!",
        'ru' => "Заказ недоступен!",
        'en' => "Order not available!",
    ];
    const PAY_CONFIRM_ORDER_MESSAGE = [
        'uz' => "🟢 To'lov tasdiqlandi!",
        'ru' => "🟢 Оплата подтверждена!",
        'en' => "🟢 Payment confirmed!",
    ];
    const SENDED_ORDER_MESSAGE = [
        'uz' => "🔵 Jo'natildi!",
        'ru' => "🔵Отправлено!",
        'en' => "🔵 Sent!",
    ];
    const CLIENT_CANCEL_ORDER_MESSAGE = [
        'uz' => "🔴 Buyurtmachi bekor qildi!",
        'ru' => "🔴 Клиент отменен!",
        'en' => "🔴 Customer canceled!",
    ];
    const OPERATOR_CANCEL_ORDER_MESSAGE = [
        'uz' => "🔴 Operator bekor qildi!",
        'ru' => "🔴 Оператор отменил!",
        'en' => "🔴 The operator canceled!",
    ];
    const YOUR_ORDER_MESSAGE = [
        'uz' => "Sizning buyurtmangiz!",
        'ru' => "Ваш заказ!",
        'en' => "Your order!",
    ];
    const NOT_PHONE_MESSAGE = [
        'uz' => "Telefon raqam formati noto’g’ri!",
        'ru' => "Неверный формат номера телефона!",
        'en' => "The phone number format is incorrect!",
    ];
    const SEND_SMS_MESSAGE = [
        'uz' => "SMS yuborildi!",
        'ru' => "СМС отправлено!",
        'en' => "SMS sent!",
    ];
    const BLOCK_TRY_AGAIN_MESSAGE = [
        'uz' => "Siz bloklandingiz, keyinroq urinib ko'ring!",
        'ru' => "Вы заблокированы, попробуйте позже!",
        'en' => "You are blocked, try again later!",
    ];
    const NOT_SMS_CODE_MESSAGE = [
        'uz' => "SMS kod mavjud emas!",
        'ru' => "СМС-код недоступен!",
        'en' => "SMS code is not available!",
    ];
    const TRY_AGAIN_PHONE_MESSAGE = [
        'uz' => "Urinishlar soni tugadi, iltimos telefon nomerni qayta yuboring!",
        'ru' => "Количество попыток истекло, пожалуйста, пришлите номер телефона еще раз!",
        'en' => "The number of attempts has expired, please resend the phone number!",
    ];
    const WRONG_SMS_CODE_MESSAGE = [
        'uz' => "SMS kod noto'g'ri!",
        'ru' => "Неверный SMS-код!",
        'en' => "The SMS code is incorrect!",
    ];
    const IN_LOGIN_MESSAGE = [
        'uz' => "Siz logindan o'tgansiz!",
        'ru' => "Вы вошли в систему!",
        'en' => "You are logged in!",
    ];
    const USER_FIRST_DELETED_MESSAGE = [
        'uz' => "Brend avval o'chirilgan!",
        'ru' => "Марка ранее удален!",
        'en' => "Brand previously deleted!",
    ];
    const USER_DELETE_MESSAGE = [
        'uz' => "Brend o'chirildi!",
        'ru' => "Марка удален!",
        'en' => "Brand deleted!",
    ];

//    errors
//   bot texts

    const BOT_USER_NOT = [
        'uz' => "👨‍💻Foydalanuvchi mavjud emas!",
        'ru' => "👨‍💻Пользователь не существует!",
        'en' => "👨‍💻The user does not exist!",
    ];
    const BOT_ASK_PHONE = [
        'uz' => "Telefon raqamingizni yuboring",
        'ru' => "Отправить свой номер телефона",
        'en' => "Send your phone number",
    ];
    const BOT_SEND_PHONE = [
        'uz' => "Telefon raqamimni yuborish",
        'ru' => "Отправить мой номер телефона",
        'en' => "Send my phone number",
    ];
    const BOT_ORDER_TYPE = [
        'uz' => "Buyurtma turini tanlang:",
        'ru' => "Выберите тип заказа:",
        'en' => "Select the order type:",
    ];

    const BOT_ORDER_MIN_SUMMA = [
        'uz' => "⚠️ Buyurtma berish minimal summasi: ",
        'ru' => "⚠️ Минимальная сумма заказа: ",
        'en' => "⚠️ Minimum order amount: ",
    ];
    const BOT_BRANCH_CHANGE = [
        'uz' => "Shahar filiallaridan birini tanlang",
        'ru' => "Выберите один из филиалов города",
        'en' => "Choose one of the city branches",
    ];
    const BOT_STOP_ORDER = [
        'uz' => "⚠️ Hozircha buyurtma olish xizmati to'xtatilgan!",
        'ru' => "⚠️ Прием заказов временно приостановлен!",
        'en' => "⚠️ The order receiving service has been suspended for now!",
    ];
    const BOT_STOP_DELIVERY = [
        'uz' => "⚠️ Hozircha yetkazib berish xizmati to'xtatilgan!\nBoshqa xizmatdan foydalanishingiz mumkin.",
        'ru' => "⚠️ Служба доставки временно приостановлена!\nВы можете воспользоваться другой службой.",
        'en' => "⚠️ The delivery service is suspended for now!\nYou can use another service.",
    ];
    const BOT_STOP_PICK_UP = [
        'uz' => "⚠️ Hozircha olib ketish xizmati to'xtatilgan!\nBoshqa xizmatdan foydalanishingiz mumkin.",
        'ru' => "⚠️ Услуга самовывоза временно приостановлена!\nВы можете воспользоваться другой услугой.",
        'en' => "⚠️ Pickup service is suspended for now!\nYou can use another service.",
    ];
    const BOT_STOP_PAY_BANK = [
        'uz' => "⚠️ Hozircha Bank karta orqali to'lov xizmati to'xtatilgan!\nBoshqa xizmatdan foydalanishingiz mumkin.",
        'ru' => "⚠️ Услуга оплаты банковской картой временно приостановлена!\nВы можете воспользоваться другой услугой.",
        'en' => "⚠️ Bank card payment service is suspended for now!\nYou can use another service.",
    ];
    const BOT_STOP_PAY_CASH = [
        'uz' => "⚠️ Hozircha Naqd pul orqali to'lov xizmati to'xtatilgan!\nBoshqa xizmatdan foydalanishingiz mumkin.",
        'ru' => "⚠️ Услуга оплаты наличными временно приостановлена!\nВы можете воспользоваться другой услугой.",
        'en' => "⚠️ Cash payment service is suspended for now!\nYou can use another service.",
    ];
    const BOT_STOP_DISTANCE = [
        'uz' => "Sizning manzilingizga yetkazib berish mavjud emas! Iltimos, boshqa joyni belgilang!",
        'ru' => "Доставка по вашему адресу невозможна! Укажите другое место!",
        'en' => "Delivery to your address is not available! Please specify another location!",
    ];
    const BOT_CHANGE_DISTANCE = [
        'uz' => "Buyurtma manzili sifatida sizning turgan nuqtangiz tanlandi!",
        'ru' => "Ваше местоположение было выбрано в качестве адреса для заказа!",
        'en' => "Your location has been selected as the order address!",
    ];
    const BOT_ASK_ADDRESS = [
        'uz' => "Ushbu manzilni tasdiqlaysizmi?",
        'ru' => "Подтвердить этот адрес?",
        'en' => "Confirm this address?",
    ];
    const BOT_MENU = [
        'uz' => "🔍Taomnomani ko’rish",
        'ru' => "🔍 Посмотреть меню",
        'en' => "🔍 View the menu",
    ];
    const BOT_ABOUT = [
        'uz' => "ℹ️ Biz haqimizda",
        'ru' => "️ℹ️ О нас",
        'en' => "️ℹ️ About us",
    ];
    const BOT_MY_ORDERS = [
        'uz' => "📋 Buyurtmalar tarixi",
        'ru' => "️📋 История заказов",
        'en' => "️📋 History of orders",
    ];

    const BOT_TO_WORK = [
        'uz' => "📅 Ish jadvali",
        'ru' => "️📅 График работы",
        'en' => "️📅 Work schedule",
    ];
    const BOT_FEEDBACK = [
        'uz' => "✍️ Fikr bildirish",
        'ru' => "✍️ Комментарий",
        'en' => "️✍️ Comment",
    ];
    const BOT_SETTING = [
        'uz' => "⚙️ Sozlamalar",
        'ru' => "⚙️ Настройки",
        'en' => "️⚙️ Settings",
    ];
    const BOT_OR_TYPE_DEL = [
        'uz' => "🛵 Yetkazib berish",
        'ru' => "🛵 Доставка",
        'en' => "️🛵 Delivery",
    ];
    const BOT_OR_TYPE_PICK_UP = [
        'uz' => "🚶 Borib olish",
        'ru' => "🚶 Забрать",
        'en' => "️🚶 Pick up",
    ];
    const BOT_ASK_NO = [
        'uz' => "✖️ Yo'q",
        'ru' => "✖️ Нет",
        'en' => "✖️ No",
    ];
    const BOT_ASK_YES = [
        'uz' => "✅ Ha",
        'ru' => "✅ Да",
        'en' => "✅ Yes",
    ];

    const BOT_ASK_OLD_YES = [
        'uz' => "✅ Avvalgisidan foydalanish",
        'ru' => "✅ Используя предыдущий",
        'en' => "✅ Using the previous one",
    ];
    const BOT_MAKE_ORDER = [
        'uz' => "✅ Buyurtma berish",
        'ru' => "✅ Заказат",
        'en' => "✅ Make order",
    ];
    const BOT_CLEAR_BASKET = [
        'uz' => "🛒 Savatni tozalash 🔄",
        'ru' => "🛒 Очистить корзину 🔄",
        'en' => "🛒 Clear the basket 🔄",
    ];
    const BOT_TO_MENU = [
        'uz' => "⬅️ Asosiy",
        'ru' => "⬅️ Основное",
        'en' => "⬅️ Home",
    ];
    const BOT_TO_BASKET = [
        'uz' => "🛒 Savatga o'tish",
        'ru' => "🛒 Перейти в корзину",
        'en' => "🛒 Go to cart",
    ];
    const BOT_START_TEXT = [
        'uz' => "Birga buyurtma beramiz!🚀\nMarhamat taomnoma va aksiyalarimiz bilan tanishishingiz mumkun!\n ",
        'ru' => "Будем заказывать вместе!🚀\nПожалуйста, можете ознакомиться с нашим меню и акциями!\n ",
        'en' => "We will order together! 🚀\nPlease, you can familiarize yourself with our menu and promotions!",
    ];

    const BOT_STOP_TEXT = [
        'uz' => "⚠️ Ushbu bot faoliyati vaqtincha to'xtatilgan!",
        'ru' => "⚠️ Работа бота временно приостановлена!",
        'en' => "⚠️ This bot is temporarily suspended!",
    ];
    const BOT_ASK_LANG = [
        'uz' => "So’zlashuv tilini tanlang!",
        'ru' => "Выберите язык общения!",
        'en' => "Choose the language of conversation!",
    ];
    const BOT_ASK_BRANCH_ORDER = [
        'uz' => "Qaysi filialimizga buyurtma bermoqchisiz?",
        'ru' => "В каком из наших филиалов вы хотели бы сделать заказ?",
        'en' => "Which of our branches would you like to order from?",
    ];
    const BOT_NOT_BRANCHES = [
        'uz' => "⚠️ Filiallar mavjud emas!",
        'ru' => "⚠️ Ветки недоступны!",
        'en' => "⚠️ Branches are not available!",
    ];
    const BOT_ASK_CATEGORY = [
        'uz' => "Taom turini tanlang:",
        'ru' => "Выберите тип питания:",
        'en' => "Select the type of food:",
    ];
    const BOT_NOT_CATEGORIES = [
        'uz' => "⚠️ Kategoriyalar mavjud emas!",
        'ru' => "⚠️ Категорий нет!",
        'en' => "⚠️ There are no categories!",
    ];
    const BOT_ADD_TO_BASKET = [
        'uz' => "➕ Savatga qo'shish",
        'ru' => "➕ В корзину",
        'en' => "➕ Add to cart",
    ];
    const BOT_MORE = [
        'uz' => "Batafsil",
        'ru' => "Более",
        'en' => "More",
    ];
    const BOT_PRICE = [
        'uz' => "Narxi",
        'ru' => "Цена",
        'en' => "Price",
    ];
    const BOT_NOT_PRODUCTS = [
        'uz' => "⚠️ Mahsulotlar mavjud emas!",
        'ru' => "⚠️ Товара нет в наличии!",
        'en' => "⚠️ Products are not available!",
    ];
    const BOT_NOT_PRODUCT = [
        'uz' => "⚠️ Mahsulot mavjud emas!",
        'ru' => "⚠️ Товара нет в наличии!",
        'en' => "⚠️ Product not available!",
    ];
    const BOT_EMPTY_BASKET = [
        'uz' => "🛒 Savat bo'sh!",
        'ru' => "🛒 Корзина пуста!",
        'en' => "🛒 Cart is empty!",
    ];
    const BOT_BASKET_PRODUCTS = [
        'uz' => "🛒 Savatdagi mahsulotlar",
        'ru' => "🛒 Товары в корзине",
        'en' => "🛒 Products in the basket",
    ];

    const BOT_PRODUCTS = [
        'uz' => "🛒 Mahsulotlar",
        'ru' => "🛒 Товары",
        'en' => "🛒 Products",
    ];
    const BOT_TOTAL_SUMM = [
        'uz' => "💰 Jami summa",
        'ru' => "💰 Общая сумма",
        'en' => "💰 Total amount",
    ];
    const BOT_CLEARED_BASKET = [
        'uz' => "⚠️ Savat tozalandi!",
        'ru' => "⚠️ Корзина очищена!",
        'en' => "⚠️ Cart cleared!",
    ];
    const BOT_ASK_FOR_DELIVERY = [
        'uz' => "Yetkazib berish uchun geo-joylashuvni yuboring",
        'ru' => "Укажите геолокацию для доставки",
        'en' => "Submit geo-location for delivery",
    ];
    const BOT_ASK_FOR_PICK_UP = [
        'uz' => "Borib olish uchun geo-joylashuvni jo'nating, sizga yaqin bo'lgan filialni aniqlaymiz",
        'ru' => "Отправьте свое местоположение, чтобы забрать, и мы найдем ближайший к вам филиал",
        'en' => "Submit your geo-location to pick up and we'll locate a branch near you",
    ];
    const BOT_SEND_LOCATION = [
        'uz' => "📍 Geolokatsiyani yuborish",
        'ru' => "📍 Отправить геолокацию",
        'en' => "📍 Send geolocation",
    ];
    const BOT_ORDER_PAY_BANK = [
        'uz' => "💳 Bank karta",
        'ru' => "💳 Банковская карта",
        'en' => "💳 Bank card",
    ];
    const BOT_ORDER_PAY_CASH = [
        'uz' => "💵 Naqd pul",
        'ru' => "💵 Наличные",
        'en' => "💵 Cash",
    ];
    const BOT_CHANGE_PAY_ACCEPT = [
        'uz' => "💳 To'lov turini tanlang va buyurtma tasdiqlanadi!",
        'ru' => "💳 Выберите способ оплаты и заказ будет подтвержден!",
        'en' => "💳 Select the payment type and the order will be confirmed!",
    ];
    const BOT_DELIVERY_SUMM = [
        'uz' => "🛵 Yetkazib berish summasi",
        'ru' => "🛵 Сумма доставки",
        'en' => "🛵 Delivery amount",
    ];

    const BOT_DELIVERY_TAXI = [
        'uz' => "Yetkazilganda hisoblanadi!",
        'ru' => "Рассчитывается при доставке!",
        'en' => "Calculated when delivered!",
    ];
    const BOT_PRODUCTS_SUMM = [
        'uz' => "🛍 Mahsulotlar summasi",
        'ru' => "🛍 Сумма произведений",
        'en' => "🛍 Sum of products",
    ];
    const BOT_ADDRESS = [
        'uz' => "📍 Manzil koordinatalari",
        'ru' => "📍 Координаты адреса",
        'en' => "📍 Address coordinates",
    ];
    const BOT_ORDER_SAVED = [
        'uz' => "🛍 Buyurtmangiz muvaffaqiyatli yuborildi! Tez orada buyurtma holati haqida xabar qabul qilasiz!",
        'ru' => "🛍 Ваш заказ успешно отправлен! Вскоре вы получите сообщение о статусе заказа!",
        'en' => "🛍 Your order has been sent successfully! You will receive an order status message soon!",
    ];


    const BOT_ORDER_NEW = [
        'uz' => "tekshirilmoqda...",
        'ru' => "проверка...",
        'en' => "checking...",
    ];

    const BOT_HAVE_NEW_ORDER = [
        'uz' => "Yangi buyurtma mavjud!",
        'ru' => "Есть новый заказ!",
        'en' => "There is a new order!",
    ];

    const BOT_ACCEPT_PAYMENT = [
        'uz' => "To'lovingiz tasdiqlandi!",
        'ru' => "Ваш платеж подтвержден!",
        'en' => "Your payment has been confirmed!",
    ];

    const BOT_REJECT_PAYMENT = [
        'uz' => "To'lovingiz bekor qilindi!",
        'ru' => "Ваш платеж был отменен!",
        'en' => "Your payment has been cancelled!",
    ];

    const BOT_HAVE_ARREARAGE = [
        'uz' => "Sizda qarzdorlik mavjud!",
        'ru' => "У тебя есть долг!",
        'en' => "You have debt!",
    ];

    const BOT_ORDER_ACCEPT = [
        'uz' => "tasdiqlandi",
        'ru' => "подтвержденный",
        'en' => "confirmed",
    ];
    const BOT_ORDER_PROCESSING = [
        'uz' => "jarayonda",
        'ru' => "в ходе выполнения",
        'en' => "in progress",
    ];

    const BOT_ORDER_CONNECTED = [
        'uz' => "yo'lda...",
        'ru' => "в пути...",
        'en' => "on the way...",
    ];
    const BOT_ORDER_SENDED = [
        'uz' => "jo'natildi",
        'ru' => "отправил",
        'en' => "sent",
    ];
    const BOT_ORDER_COMPLETED = [
        'uz' => "muvaffaqiyatli tugatildi",
        'ru' => "завершено успешно",
        'en' => "completed successfully",
    ];
    const BOT_ORDER_OPERATOR_CANCEL = [
        'uz' => "operator bekor qildi",
        'ru' => "оператор отменил",
        'en' => "the operator canceled",
    ];
    const BOT_PAY_WITH_BANK = [
        'uz' => "Bank kartasi orqali",
        'ru' => "Банковской картой",
        'en' => "By bank card",
    ];
    const BOT_PAY_WITH_CASH = [
        'uz' => "Naqd pul orqali",
        'ru' => "Наличными",
        'en' => "By cash",
    ];
    const BOT_PAY_TYPE = [
        'uz' => "💲 To'lov turi",
        'ru' => "💲 Тип оплаты",
        'en' => "💲 Payment type",
    ];

    const BOT_DELIVERY_TYPE = [
        'uz' => "Yetkazib berish turi",
        'ru' => "💲 Тип оплаты",
        'en' => "💲 Payment type",
    ];
    const BOT_STATUS = [
        'uz' => "Holat",
        'ru' => "Положение дел",
        'en' => "Status",
    ];
    const BOT_YOUR_ORDER = [
        'uz' => "Sizning buyurtmangiz",
        'ru' => "Твоя заказа",
        'en' => "Your order",
    ];
    const BOT_NUMBER_ORDER = [
        'uz' => "Buyurtma raqami",
        'ru' => "Номер заказа",
        'en' => "Order number",
    ];

    const BOT_YOUR_BALANCE = [
        'uz' => "Sizning balansingizda mavjud",
        'ru' => "Доступно на вашем балансе",
        'en' => "Available in your balance",
    ];
    const BOT_TIME = [
        'uz' => "🕐 Vaqti",
        'ru' => "🕐 Время",
        'en' => "🕐 Time",
    ];
    const BOT_CHANGE_ONE = [
        'uz' => "Quyidagilardan birini tanlang",
        'ru' => "Выберите один из следующих",
        'en' => "Choose one of the following",
    ];
    const BOT_NOT_ORDERS = [
        'uz' => "🛍 Buyurtmalar mavjud emas!",
        'ru' => "🛍 Заказов нет!",
        'en' => "🛍 Orders are not available!",
    ];
    const BOT_TO_BACK = [
        'uz' => "⬅️ Ortga",
        'ru' => "⬅️ Назад",
        'en' => "⬅️ Back",
    ];

    const BOT_GET_LANG = [
        'uz' => "Muloqot tili",
        'ru' => "Язык",
        'en' => "Language",
    ];

    const BOT_GET_PHONE = [
        'uz' => "Telefon",
        'ru' => "Телефон",
        'en' => "Phone",
    ];
    const BOT_GET_BRANCH = [
        'uz' => "Shahar",
        'ru' => "Город",
        'en' => "Region",
    ];
    const BOT_CHANGE_LANG = [
        'uz' => "Tilni o'zgartirish",
        'ru' => "Изменить язык",
        'en' => "Change the language",
    ];

    const BOT_CHANGE_PHONE = [
        'uz' => "Telefonni o'zgartirish",
        'ru' => "Сменить телефон",
        'en' => "Change the phone",
    ];
    const BOT_CHANGE_BRANCH = [
        'uz' => "Shaharni o'zgartirish",
        'ru' => "Изменить город",
        'en' => "Change region",
    ];
    const BOT_ASK_FEEDBACK = [
        'uz' => "Fikr va mulohazalaringizni yuboring",
        'ru' => "Присылайте свои мысли и комментарии",
        'en' => "Submit your thoughts and comments",
    ];
    const BOT_SAVED = [
        'uz' => "Yuborildi! Sizga xizmat ko'rsatishdan mamnunmiz!",
        'ru' => "Отправил! Мы рады служить вам!",
        'en' => "Sent! We are happy to serve you!",
    ];

    const BOT_NOT_ORDER_DAY = [
        'uz' => "Afsuski, bugun buyurtmalar qabul qilinmaydi!",
        'ru' => "К сожалению, сегодня заказы не принимаются!",
        'en' => "Unfortunately, orders are not accepted today!",
    ];

    const BOT_NOT_ORDER_TIME = [
        'uz' => "Buyurtmalar qabul qilish vaqt oralig'i: ",
        'ru' => "Сроки приема заказов: ",
        'en' => "Time frame for receiving orders: ",
    ];

    const BOT_PHONE_FOR_CONNECT = [
        'uz' => "Bog'lanish uchun telefon raqam: ",
        'ru' => "Контактный телефон: ",
        'en' => "Contact phone number: ",
    ];

    const BOT_PHONE_FOR_SUPPORT = [
        'uz' => "Texnik yordam uchun telefon raqam: ",
        'ru' => "Телефон для технической поддержки: ",
        'en' => "Phone number for technical support: ",
    ];

    const BOT_NOT_ORDER_DAYS = [
        'uz' => "Buyurtmalar qabul qilish kunlari: ",
        'ru' => "Дни приема заказов: ",
        'en' => "Days of receiving orders: ",
    ];


    const BOT_WEEK_DAY_MON = [
        'uz' => "Dushanba",
        'ru' => "Понедельник",
        'en' => "Monday",
    ];

    const BOT_WEEK_DAY_TUE = [
        'uz' => "Seshanba",
        'ru' => "Вторник",
        'en' => "Tuesday",
    ];

    const BOT_WEEK_DAY_WED = [
        'uz' => "Chorshanba",
        'ru' => "Среда",
        'en' => "Wednesday",
    ];

    const BOT_WEEK_DAY_THU = [
        'uz' => "Payshanba",
        'ru' => "Четверг",
        'en' => "Thursday",
    ];

    const BOT_WEEK_DAY_FRI = [
        'uz' => "Juma",
        'ru' => "Пятница",
        'en' => "Friday",
    ];

    const BOT_WEEK_DAY_SAT = [
        'uz' => "Shanba",
        'ru' => "Суббота",
        'en' => "Saturday",
    ];

    const BOT_WEEK_DAY_SUN = [
        'uz' => "Yakshanba",
        'ru' => "Воскресенье",
        'en' => "Sunday",
    ];

    const BOT_FULL_VIEW = [
        'uz' => "👁‍🗨 To'liq ko'rish",
        'ru' => "👁‍🗨 Полный обзор",
        'en' => "👁‍🗨 Full view",
    ];


//   bot texts

    public function sendResponse($result, $success = NULL, $message = NULL, $error_code = 0)
    {
        $response = [
            'success' => $success,
            'data' => $result,
            'message' => $message,
            'error_code' => $error_code,

        ];

        return response()->json($response, 200);
    }

    public function getApiKey()
    {

        $headers = getallheaders();
        return (isset($headers['Key'])) ? $headers['Key'] : 'no_key';
    }

    public function getLang()
    {
        $headers = getallheaders();
        return (isset($headers['Lang'])) ? $headers['Lang'] : 'uz';
    }

    public function getToken()
    {

        $headers = getallheaders();
        return (isset($headers['Token'])) ? $headers['Token'] : 'no_token';
    }

    public function user()
    {
        return AppUser::where('token', $this->getToken())->first();
    }

    public function checkBranchOrderCount($branch_id, $order_id)
    {

//        tariffs
//        max_month_order_counts
        $free = 100;
        $low = 1000;
        $medium = 2000;
//        max_month_order_counts
//        out_limit_one_order_summa
        $free_summa = 0;
        $low_summa = 1500;
        $medium_summa = 1200;
        $high_summa = 1000;
//        out_limit_one_order_summa

        $branch = Branch::where(['id' => $branch_id, 'status' => 'active'])->first();

        if ($branch != null){
            $branch->update([
                'full_order_count' => $branch->full_order_count + 1
            ]);
        }

    }

    public function sendBot($method, $datas = [], $brand_id = null)
    {
        $key = self::BOT_TOKEN;
        if ($brand_id != null) {
            $brand = Brand::where('id', $brand_id)->first();
            if ($brand != null) {
                $bot = Bot::where(['brand_id' => $brand->id, 'status' => 'active'])->first();
                if ($bot != null) {
                    $key = $bot->bot_token;
                }
            }
        }
        $url = "https://api.telegram.org/bot" . $key . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res);
        }
    }

    public function getButtons($order_or_user_id, $button_text, $status, $type)
    {
        $button = [
            'text' => $button_text,
            'callback_data' => json_encode(array("id" => $order_or_user_id, "st" => $status, "tp" => $type))
        ];
        return $button;
    }


    function sendPaymentToSocket($brand_id, $branch_id, $summa, $type){
        $branch = Branch::where(['id' => $branch_id, 'status' => 'active'])->first();
//        $check_arrearage = false;
//        if($branch != null && $branch->arrearage > 0){
//            $check_arrearage = true;
//        }
        $control_users = ControlUser::whereNotNull('socket_id')->where([
            'brand_id' => $brand_id,
            'branch_id' => $branch_id,
            'allow_app_order' => 1,
        ])->get();
        $socket_url = Controller::SOCKET_BASE_URL;
        $send_url = $socket_url . "accept_payment";
        $client = new GuzzleHttp\Client();

        foreach ($control_users as $control_user) {
            $response = [
                'user_socket_id' => $control_user->socket_id,
            ];
            $data = $client->post($send_url, [
                'json' => $response,
            ]);

            $lang = $control_user->lang != null ? $control_user->lang : "uz";

            // send fcm
            $your_payment = "";
            if ($type == "accepted"){
                $your_payment = Controller::BOT_ACCEPT_PAYMENT[$lang];
            }else{
                $your_payment = Controller::BOT_REJECT_PAYMENT[$lang];
            }
            $summa = Controller::BOT_YOUR_BALANCE[$lang] . ": $summa SUM";
            Controller::sendFCM("$your_payment", $summa, "notify", "payment", $control_user->fcm_token, $control_user->lang);
            // send fcm
        }

        return 0;
    }


    public function sendToSocket($brand_id, $branch_id, $order_id = 0)
    {

        $branch = Branch::where(['id' => $branch_id, 'status' => 'active'])->first();
        $check_arrearage = false;
        if($branch != null && $branch->balance < 0){
            $check_arrearage = true;
        }
        $control_users = ControlUser::whereNotNull('socket_id')->where([
            'brand_id' => $brand_id,
            'branch_id' => $branch_id,
            'allow_app_order' => 1,
        ])->get();
        $socket_url = self::SOCKET_BASE_URL;
        $send_url = $socket_url . "send_order";
        $client = new GuzzleHttp\Client();

        foreach ($control_users as $control_user) {
            $response = [
                'user_socket_id' => $control_user->socket_id,
                'status' => "new_order",
            ];
            $data = $client->post($send_url, [
                'json' => $response,
            ]);

            $lang = $control_user->lang != null ? $control_user->lang : "uz";
            $have_arrearage = "";
            if($check_arrearage){
                $have_arrearage = self::BOT_HAVE_ARREARAGE[$lang];
            }
            // send fcm
            $new_order = self::BOT_HAVE_NEW_ORDER[$lang];
            $order_number = self::BOT_NUMBER_ORDER[$lang] . ": $order_id";
            $this->sendFCM("$new_order $have_arrearage", $order_number, "new_order", "new_order", $control_user->fcm_token, $control_user->lang);
            // send fcm
        }
        return 0;
    }

    public function sendFCM($title, $content, $content_type, $send_type, $fcm_token, $lang = null)
    {
        if ($send_type == 'all') {
            $to = "/topics/news_" . $lang;
            $data = array(
                "to" => $to,
                "notification" => array(
                    "title" => $title,
                    "body" => $content
                ),
                "data" => array(
                    "type" => $content_type,
                ));

            $data_string = json_encode($data);
            // echo "The Json Data : ".$data_string;
            try {
                $headers = array('Authorization: key=' . self::API_ACCESS_KEY, 'Content-Type: application/json');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                $result = curl_exec($ch);
                curl_close($ch);
            } catch (\Throwable $th) {
            }

        } else {
            $data = array(
                "to" => $fcm_token,
                "data" => array(
                    "type" => $content_type,
                    "title" => $title,
                    "body" => $content
                ));

            $data_string = json_encode($data);
            // echo "The Json Data : ".$data_string;
            try {
                $headers = array('Authorization: key=' . self::API_ACCESS_KEY, 'Content-Type: application/json');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                $result = curl_exec($ch);
                curl_close($ch);
            } catch (\Throwable $th) {
            }
        }
    }
}
