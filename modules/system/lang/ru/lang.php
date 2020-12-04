<?php

return [
    'app'            => [
        'name'    => 'October CMS',
        'tagline' => 'Возвращение к истокам',
    ],
    'directory'      => [
        'create_fail' => 'Невозможно создать директорию: :name',
    ],
    'file'           => [
        'create_fail' => 'Невозможно создать файл: :name',
    ],
    'combiner'       => [
        'not_found' => "Сборщик ресурсов не может найти файл ':name'.",
    ],
    'system'         => [
        'name'       => 'Система',
        'menu_label' => 'Система',
        'categories' => [
            'cms'           => 'CMS',
            'misc'          => 'Разное',
            'logs'          => 'Логи',
            'mail'          => 'Почта',
            'shop'          => 'Магазин',
            'team'          => 'Команда',
            'users'         => 'Пользователи',
            'system'        => 'Система',
            'social'        => 'Социальное',
            'backend'       => 'Backend',
            'events'        => 'События',
            'customers'     => 'Клиентское',
            'my_settings'   => 'Мои настройки',
            'notifications' => 'Уведомления',
        ],
    ],
    'theme'          => [
        'label'   => 'Тема',
        'unnamed' => 'Безымянная тема',
        'name'    => [
            'label' => 'Название темы',
            'help'  => 'Название темы по ее уникальному коду. Например, RainLab.Vanilla',
        ],
    ],
    'themes'         => [
        'install'        => 'Установить темы',
        'search'         => 'поиск тем для установки...',
        'installed'      => 'Установленные темы',
        'no_themes'      => 'Нет тем, установленных из магазина.',
        'recommended'    => 'Рекомендуется',
        'remove_confirm' => 'Вы уверены, что хотите удалить выбранную тему?',
    ],
    'plugin'         => [
        'label'   => 'Плагин',
        'unnamed' => 'Безымянный плагин',
        'name'    => [
            'label' => 'Имя плагина',
            'help'  => 'Введите название плагина со своим уникальным кодом. Например, RainLab.Blog',
        ],
        'by_author' => 'Создано :name',
    ],
    'plugins'        => [
        'manage'                  => 'Управление плагинами',
        'install'                 => 'Установить плагины',
        'install_products'        => 'Установка расширений',
        'search'                  => 'поиск плагинов для установки...',
        'installed'               => 'Установленные плагины',
        'no_plugins'              => 'Нет плагинов, установленных из магазина.',
        'recommended'             => 'Рекомендуется',
        'plugin_label'            => 'Плагин',
        'unknown_plugin'          => 'Плагин был удален из файловой системы.',
        'select_label'            => 'Выберите действие...',
        'bulk_actions_label'      => 'Массовые действия',
        'check_yes'               => 'Да',
        'check_no'                => 'Нет',
        'unfrozen'                => 'Обновления включены',
        'enabled'                 => 'Плагин включен',
        'freeze'                  => 'отключить обновления для',
        'unfreeze'                => 'включить обновления для',
        'enable'                  => 'включить',
        'disable'                 => 'выключить',
        'refresh'                 => 'сбросить',
        'remove'                  => 'Удалить',
        'freeze_label'            => 'Выключить обновления',
        'unfreeze_label'          => 'Включить обновления',
        'enable_label'            => 'Включить плагины',
        'disable_label'           => 'Отключить плагины',
        'refresh_label'           => 'Сбросить данные плагина',
        'action_confirm'          => 'Вы уверены что хотите :action эти плагины?',
        'freeze_success'          => 'Обновления успешно выключены для выбранных плагинов.',
        'unfreeze_success'        => 'Обновления успешно включены для выбранных плагинов.',
        'enable_success'          => 'Выбранные плагины успешно включены.',
        'disable_success'         => 'Выбранные плагины успешно выключены.',
        'refresh_confirm'         => 'Вы уверены, что хотите сбросить данные выбранных плагинов? Это приведет к сбросу данных каждого плагина, восстановив его в исходное состояние.',
        'refresh_success'         => 'Выбранные плагины успешно обновлены.',
        'remove_confirm'          => 'Вы уверены, что хотите удалить выбранные Плагины? Это также приведет к удалению всех связанных данных.',
        'remove_success'          => 'Выбранные плагины успешно удалены.',
    ],
    'project'        => [
        'name'           => 'Проект',
        'owner_label'    => 'Владелец',
        'attach'         => 'Подключить проект',
        'detach'         => 'Отсоединить проект',
        'none'           => 'Не обнаружено',
        'id'             => [
            'label'   => 'Идентификатор проекта',
            'help'    => 'Как найти идентификатор вашего проекта',
            'missing' => 'Пожалуйста, укажите идентификатор вашего проекта для использования.',
        ],
        'detach_confirm' => 'Вы уверены, что хотите отсоединить этот проект?',
        'unbind_success' => 'Проект был успешно отсоединен.',
    ],
    'settings'       => [
        'menu_label'     => 'Настройки',
        'not_found'      => 'Не удается найти указанные настройки.',
        'missing_model'  => 'На странице настроек отсутствует определение модели.',
        'update_success' => 'Настройки для :name успешно обновлены.',
        'return'         => 'Вернуться к системным настройкам',
        'search'         => 'Поиск',
    ],
    'mail'           => [
        'log_file'                   => 'Файл журнала',
        'menu_label'                 => 'Настройки почты',
        'menu_description'           => 'Управление настройками электронной почты.',
        'general'                    => 'Общее',
        'method'                     => 'Метод',
        'sender_name'                => 'Имя отправителя',
        'sender_email'               => 'Адрес отправителя',
        'php_mail'                   => 'PHP mail',
        'smtp'                       => 'SMTP',
        'smtp_address'               => 'Сервер исходящей почты',
        'smtp_authorization'         => 'Использовать SMTP авторизацию',
        'smtp_authorization_comment' => 'Активируйте эту опцию, если ваш SMTP-сервер требует авторизацию.',
        'smtp_username'              => 'SMTP логин',
        'smtp_password'              => 'SMTP пароль',
        'smtp_port'                  => 'SMTP порт',
        'smtp_ssl'                   => 'Использовать SSL',
        'smtp_encryption'            => 'Протокол шифрования для SMTP',
        'smtp_encryption_none'       => 'Без шифрования',
        'smtp_encryption_tls'        => 'TLS',
        'smtp_encryption_ssl'        => 'SSL',
        'sendmail'                   => 'Sendmail',
        'sendmail_path'              => 'Путь к Sendmail',
        'sendmail_path_comment'      => 'Пожалуйста, укажите путь к sendmail.',
        'mailgun'                    => 'Mailgun',
        'mailgun_domain'             => 'Домен Mailgun',
        'mailgun_domain_comment'     => 'Пожалуйста, укажите домен Mailgun.',
        'mailgun_secret'             => 'Секретный API-ключ',
        'mailgun_secret_comment'     => 'Введите ваш Mailgun API-ключ.',
        'mandrill'                   => 'Mandrill',
        'mandrill_secret'            => 'Секретный ключ Mandrill',
        'mandrill_secret_comment'    => 'Введите ваш Mandrill API-ключ.',
        'ses'                        => 'SES',
        'ses_key'                    => 'SES API-ключ',
        'ses_key_comment'            => 'Введите ваш SES API-ключ',
        'ses_secret'                 => 'SES секретный API-ключ',
        'ses_secret_comment'         => 'Введите ваш секретный SES API-ключ',
        'sparkpost'                  => 'SparkPost',
        'sparkpost_secret'           => 'SparkPost secret',
        'sparkpost_secret_comment'   => 'Введите ваш SparkPost API secret key',
        'ses_region'                 => 'SES регион',
        'ses_region_comment'         => 'Введите ваш SES регион (например, us-east-1)',
        'drivers_hint_header'        => 'Драйвера не установлены',
        'drivers_hint_content'       => 'Этот почтовый метод требует плагин ":plugin", установленный прежде, чем можно будет отправлять почту.',
    ],
    'mail_templates' => [
        'menu_label'            => 'Шаблоны почты',
        'menu_description'      => 'Изменение шаблонов писем, отправляемых пользователям и администраторам.',
        'new_template'          => 'Новая тема',
        'new_layout'            => 'Новый шаблон',
        'new_partial'           => 'Новый фрагмент',
        'template'              => 'Шаблон',
        'templates'             => 'Шаблоны',
        'partial'               => 'Фрагмент',
        'partials'              => 'Фрагменты',
        'menu_layouts_label'    => 'Шаблоны почты',
        'menu_partials_label'   => 'Фрагменты почты',
        'layout'                => 'Шаблон',
        'layouts'               => 'Шаблоны',
        'no_layout'             => '-- Нет шаблона --',
        'name'                  => 'Название',
        'name_comment'          => 'Уникальное имя, используемое для обозначения этого шаблона',
        'code'                  => 'Код',
        'code_comment'          => 'Уникальный код, используемый для обозначения этого шаблона',
        'subject'               => 'Тема',
        'subject_comment'       => 'Тема сообщения',
        'description'           => 'Описание',
        'content_html'          => 'HTML',
        'content_css'           => 'CSS',
        'content_text'          => 'Простой текст',
        'test_send'             => 'Отправить тестовое сообщение',
        'test_success'          => 'Тестовое сообщение было успешно отправлено.',
        'test_confirm'          => 'Тестовое сообщение будет отправлено на :email. Продолжить?',
        'creating'              => 'Создание...',
        'creating_layout'       => 'Создание шаблона...',
        'saving'                => 'Сохранение...',
        'saving_layout'         => 'Сохранение шаблона...',
        'delete_confirm'        => 'Вы действительно хотите это удалить?',
        'delete_layout_confirm' => 'Вы действительно хотите удалить этот шаблон?',
        'deleting'              => 'Удаление...',
        'deleting_layout'       => 'Удаление шаблона...',
        'sending'               => 'Отправка тестового сообщения...',
        'return'                => 'Вернуться к списку шаблонов',
        'options'               => 'Опции',
        'disable_auto_inline_css' => 'Выключить автоматический встроенный CSS',
    ],
    'mail_brand'     => [
        'menu_label'       => 'Почтовый брендинг',
        'menu_description' => 'Измените цвета и внешний вид почтовых шаблонов.',
        'page_title'       => 'Настройка внешнего вида почты',
        'sample_template'  => [
            'heading'   => 'Заголовок',
            'paragraph' => 'Это абзац, содержит текст Lorem Ipsum и ссылку. Cumque dicta <a>doloremque eaque</a>, enim error laboriosam pariatur possimus tenetur veritatis voluptas.',
            'table'     => [
                'item'          => 'Пункт',
                'description'   => 'Описание',
                'price'         => 'Цена',
                'centered'      => 'По центру',
                'right_aligned' => 'По правому краю',
            ],
            'buttons'   => [
                'primary'  => 'Основная кнопка',
                'positive' => 'Положительная кнопка',
                'negative' => 'Отрицательная кнопка',
            ],
            'panel'     => 'Насколько великолепна эта панель?',
            'more'      => 'Еще один текст',
            'promotion' => 'Код купона: OCTOBER',
            'subcopy'   => 'Это подкопия письма',
            'thanks'    => 'Спасибо',
        ],
        'fields'           => [
            '_section_background'    => 'Задний план',
            'body_bg'                => 'Фон тела документа',
            'content_bg'             => 'Фон обертки содержимого',
            'content_inner_bg'       => 'Фон содержимого',
            '_section_buttons'       => 'Кнопки',
            'button_text_color'      => 'Цвет текста кнопки',
            'button_primary_bg'      => 'Цвет основной кнопки',
            'button_positive_bg'     => 'Цвет положительной кнопки',
            'button_negative_bg'     => 'Цвет отрицательной кнопки',
            '_section_type'          => 'Типография',
            'header_color'           => 'Цвет заголовка',
            'heading_color'          => 'Цвет заголовков',
            'text_color'             => 'Цвет текста',
            'link_color'             => 'Цвет ссылки',
            'footer_color'           => 'Нижний колонтитул',
            '_section_borders'       => 'Границы',
            'body_border_color'      => 'Цвет под заголовком',
            'subcopy_border_color'   => 'Цвет над колонтитулом',
            'table_border_color'     => 'Цвет таблицы',
            '_section_components'    => 'Компоненты',
            'panel_bg'               => 'Фон панели',
            'promotion_bg'           => 'Фон промо блока',
            'promotion_border_color' => 'Цвет рамки промо блока',
        ],
    ],
    'install'        => [
        'project_label'       => 'Присоединить к проекту',
        'plugin_label'        => 'Установить плагин',
        'theme_label'         => 'Установить тему',
        'missing_plugin_name' => 'Пожалуйста, укажите название плагина для установки.',
        'missing_theme_name'  => 'Пожалуйста, укажите название темы для установки.',
        'install_completing'  => 'Завершение процесса установки',
        'install_success'     => 'Плагин был успешно установлен.',
    ],
    'updates'        => [
        'title'                          => 'Менеджер обновлений',
        'name'                           => 'Обновление ПО',
        'menu_label'                     => 'Обновления и плагины',
        'menu_description'               => 'Обновление системы, управление и установка плагинов и тем.',
        'return_link'                    => 'Вернуться к системе обновлений',
        'check_label'                    => 'Проверить обновления ',
        'retry_label'                    => 'Попробовать еще раз',
        'plugin_name'                    => 'Название',
        'plugin_code'                    => 'Код',
        'plugin_description'             => 'Описание',
        'plugin_version'                 => 'Версия',
        'plugin_author'                  => 'Автор',
        'plugin_not_found'               => 'Плагин не найден',
        'plugin_version_not_found'       => 'Версия плагина не найдена',
        'core_current_build'             => 'Текущая сборка',
        'core_view_changelog'            => 'Просмотр списка изменений',
        'core_build'                     => 'Сборка :build',
        'core_build_help'                => 'Последняя доступная сборка.',
        'core_downloading'               => 'Загрузка файлов приложения',
        'core_extracting'                => 'Распаковка файлов приложения',
        'core_set_build'                 => 'Установка номера сборки',
        'update_warnings_title'          => 'Обнаружены проблемы требующие вашего внимания',
        'update_warnings_plugin_missing' => 'Плагин :code ялвяется зависисмостью плагина :parent_code, но он не обнаружен в системе. Пожалуйста установите этот плагин.',
        'changelog'                      => 'Список изменений',
        'changelog_view_details'         => 'Просмотр подробностей',
        'plugins'                        => 'Плагины',
        'themes'                         => 'Темы',
        'disabled'                       => 'Отключено',
        'plugin_downloading'             => 'Загрузка плагина: :name',
        'plugin_extracting'              => 'Распаковка плагина: :name',
        'plugin_version_none'            => 'Новый плагин',
        'plugin_current_version'         => 'Текущая версия',
        'theme_new_install'              => 'Новая тема установлена.',
        'theme_downloading'              => 'Загрузка темы: :name',
        'theme_extracting'               => 'Распаковка темы: :name',
        'update_label'                   => 'Обновить',
        'update_completing'              => 'Завершение процесса обновления',
        'update_loading'                 => 'Поиск доступных обновлений...',
        'update_success'                 => 'Процесс обновления был успешно завершен.',
        'update_failed_label'            => 'Не удалось выполнить обновление',
        'force_label'                    => 'Принудительно обновить',
        'found'                          => [
            'label' => 'Доступны новые обновления!',
            'help'  => 'Выберите «Обновить», чтобы начать процесс обновления.',
        ],
        'none'                         => [
            'label' => 'Нет обновлений',
            'help'  => 'Новые обновления не найдены.',
        ],
        'important_action'             => [
            'empty'   => 'Выберите действие',
            'confirm' => 'Подтвердите обновление',
            'skip'    => 'Пропустить этот плагин (только один раз)',
            'ignore'  => 'Пропустить этот плагин (всегда)',
        ],
        'important_action_required'    => 'Необходимое действие',
        'important_view_guide'         => 'Посмотреть руководство по обновлению',
        'important_view_release_notes' => 'Просмотреть заметки о выпуске',
        'important_alert_text'         => 'Некоторые обновления требуют вашего внимания.',
        'details_title'                => 'Информация о плагине',
        'details_view_homepage'        => 'Перейти к домашней странице',
        'details_readme'               => 'Документация',
        'details_readme_missing'       => 'Документация не предоставлена.',
        'details_changelog'            => 'Изменения',
        'details_changelog_missing'    => 'Нет никакого измененного списка.',
        'details_upgrades'             => 'Инструкция по обновлению',
        'details_upgrades_missing'     => 'Инструкция по обновлению не предоставлена.',
        'details_licence'              => 'Лицензия',
        'details_licence_missing'      => 'Лицензия не предоставляется.',
        'details_current_version'      => 'Текущая версия',
        'details_author'               => 'Автор',
    ],
    'server'         => [
        'connect_error'      => 'Ошибка подключения к серверу.',
        'response_not_found' => 'Сервер обновления не найден.',
        'response_invalid'   => 'Неверный ответ сервера.',
        'response_empty'     => 'Пустой ответ сервера.',
        'file_error'         => 'Сервер не смог доставить пакет.',
        'file_corrupt'       => 'Загруженный файл поврежден.',
    ],
    'behavior'       => [
        'missing_property' => 'Класс :class должен содержать свойство $:property, используемое расширением :behavior.',
    ],
    'config'         => [
        'not_found' => 'Не удалось найти конфигурационный файл :file, ожидаемый для :location.',
        'required'  => "Для конфигурации, используемой в :location не указано свойство ':property'.",
    ],
    'zip'            => [
        'extract_failed' => "Невозможно извлечь файл ':file'.",
    ],
    'event_log'      => [
        'hint'             => 'В этом журнале отображается список возможных ошибок, которые возникают в работе приложения, таких как исключения и отладочная информация.',
        'menu_label'       => 'Журнал событий',
        'menu_description' => 'Просмотр системного журнала событий.',
        'empty_link'       => 'Очистить журнал событий',
        'empty_loading'    => 'Очищение журнала событий...',
        'empty_success'    => 'Успешное очищение журнала событий.',
        'return_link'      => 'Вернуться в журнал событий',
        'id'               => 'ID',
        'id_label'         => 'ID события',
        'created_at'       => 'Дата & Время',
        'message'          => 'Сообщение',
        'level'            => 'Уровень',
        'preview_title'    => 'События',
    ],
    'request_log'    => [
        'hint'             => 'В этом журнале отображается список запросов браузера, которые могут потребовать внимания. Например, если посетитель открывает несуществующую страницу, то в журнале создается запись с кодом статуса 404.',
        'menu_label'       => 'Журнал запросов',
        'menu_description' => 'Просмотр неудачных или перенаправленных запросов.',
        'empty_link'       => 'Очистить журнал запросов',
        'empty_loading'    => 'Очищение журнала запросов...',
        'empty_success'    => 'Успешное очищение журнала запросов.',
        'return_link'      => 'Вернуться к журналу запросов',
        'id'               => 'ID',
        'id_label'         => 'ID записи',
        'count'            => 'Счетчик',
        'referer'          => 'Источник запроса',
        'url'              => 'Адрес',
        'status_code'      => 'Статус',
        'preview_title'    => 'Запрос',
    ],
    'permissions'    => [
        'name'                        => 'Система',
        'manage_system_settings'      => 'Настройка системных параметров',
        'manage_software_updates'     => 'Управление обновлениями',
        'access_logs'                 => 'Просмотр системных логов',
        'manage_mail_templates'       => 'Управление почтовыми шаблонами',
        'manage_mail_settings'        => 'Управление настройками почты',
        'manage_other_administrators' => 'Управление другими администраторами',
        'impersonate_users'           => 'Выдавать себя за пользователей',
        'manage_preferences'          => 'Управление настройками бэкенда',
        'manage_editor'               => 'Управление настройками редактора кода',
        'view_the_dashboard'          => 'Просмотр панели управления',
        'manage_default_dashboard'    => 'Управление панелью управления по умолчанию',
        'manage_branding'             => 'Персонализация панели управления',
    ],
    'log'            => [
        'menu_label'           => 'Настройки журналов',
        'menu_description'     => 'Укажите для каких частей CMS следует вести журнал.',
        'default_tab'          => 'Ведение журнала',
        'log_events'           => 'Сохранять системные события',
        'log_events_comment'   => 'Хранить системные события в базе данных в дополнение к файловому журналу.',
        'log_requests'         => 'Сохранять неудачные запросы',
        'log_requests_comment' => 'Запросы браузера, которые могут потребовать внимания. Например, 404 ошибки.',
        'log_theme'            => 'Сохранять изменения темы',
        'log_theme_comment'    => 'Изменения которые внесены средствами CMS.',
    ],
    'media'          => [
        'invalid_path'      => "Указан недопустимый путь к файлу: ':path'.",
        'folder_size_items' => 'объектов',
    ],
    'page' => [
        'custom_error' => [
            'label' => 'Ошибка страницы',
            'help'  => 'Приносим извинения, что-то пошло не так и страница не может быть отображена.',
        ],
        'invalid_token' => [
            'label' => 'Неверный токен безопасности',
        ],
        'maintenance' => [
            'label'        => "Мы скоро вернемся!",
            'help'         => "В настоящее время мы находимся на обслуживании, зайдите позже!",
            'message'      => 'Сообщение:',
            'available_at' => 'Попробуйте еще раз после:',
        ],
    ],
    'pagination' => [
        'previous' => 'Предыдущий',
        'next'     => 'Следующий',
    ],
];
