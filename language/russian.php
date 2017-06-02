<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/

// The locale 
$locale = 'ru-RU';
$charset = 'UTF-8';

// The name of this script.
$text['script_name'] = 'SMF Package Generator';

// Basic information section.
$text['basic_info_header'] = 'Основная информация';
$text['basic_your_name'] = 'Ваш ник';
$text['basic_mod_name'] = 'Название мода';
$text['basic_mod_version'] = 'Версия';
$text['basic_mod_type'] = 'Тип';
$text['details_header'] = 'Детали';

// Some basic buttons.
$text['button_preview'] = 'Предварительный просмотр изменений';
$text['button_download'] = 'Скачать файл';
$text['button_delete'] = 'Удалить';
$text['button_restore'] = 'Восстановить';
$text['button_collapse'] = 'Свернуть';
$text['button_expand'] = 'Развернуть';

// The Mod Maker Part
	// Details section.
	$text['details_num_files'] = 'Количество файлов';
	$text['details_num_edits'] = 'Количество правок';
	$text['details_num_lines'] = 'Количество строк';

	// Buttons.
	$text['button_add_edit'] = 'Добавить другую правку';
	$text['button_add_file'] = 'Добавить другой файл';

	// Preview.
	$text['preview_header'] = 'Ваш .xml файл';


	// File sections. Note that %1$s here represents the file number.
	$text['file_header'] = 'Файл #%1$s';

	$text['file_to_edit'] = 'Файл для редактирования';

	$text['file_not_found'] = 'Если файл не найден';
	$text['file_not_found_fatal'] = 'Сбой установки (по умолчанию)';
	$text['file_not_found_ignore'] = 'Создать файл с изменениями';
	$text['file_not_found_skip'] = 'Пропустить весь файл';


	// Edit sections. Note that %1$s here represents file number, while %2$s represents edit number.
	$text['edit_header'] = 'Файл #%1$s &mdash; Правка #%2$s';
	$text['edit_header_delete'] = 'Удалить';
	$text['edit_header_restore'] = 'Восстановить';
	$text['edit_header_collapse'] = 'Свернуть';
	$text['edit_header_expand'] = 'Развернуть';

	$text['edit_ignore_whitespace'] = 'Игнорировать пробелы';
	$text['edit_search_for'] = 'Код для поиска';
	$text['edit_replace_with'] = 'Код для замены';

	$text['edit_action'] = 'Редактирование';
	$text['edit_action_replace'] = 'Заменить выделенное следующим кодом';
	$text['edit_action_before'] = 'Добавить код после выделенного';
	$text['edit_action_after'] = 'Добавить код до выделенного';
	$text['edit_action_end'] = 'Добавить в конец файла';

	$text['edit_errors'] = 'Обработка ошибок';
	$text['edit_errors_fail'] = 'Сбой установки (по умолчанию)';
	$text['edit_errors_ignore'] = 'Создать файл с изменениями (игнорировать)';
	$text['edit_errors_required'] = 'Изменения обязательны (иначе провал)';


// The Package Info Section. Note that %1$s here represents the action number.
	$text['details_num_actions'] = 'Количество действий';
	$text['details_num_instructions'] = 'Количество команд';

	$text['button_add_action'] = 'Добавить действие';
	$text['button_add_instruct'] = 'Добавить команду';

	$text['action_header'] = 'Действие %1$s';

	// The Edit section
	$text['type_of_action'] = 'Тип действия';
	$text['type_of_action_install'] = 'Установка';
	$text['type_of_action_uninstall'] = 'Удаление';
	$text['type_of_action_upgrade'] = 'Обновление';
	$text['action_smf_versions'] = 'Версии SMF';


	// Instruction stuff. Note that %1$s here represents action number, while %2$s represents instruction number.
	$text['instruct_header'] = 'Действие #%1$s &mdash; Команда #%2$s';

	$text['instruct_action'] = 'Что сделать';
	$text['instruct_action_modification'] = 'Модификация (.xml или .mod)';
	$text['instruct_action_code'] = 'Выполняемый код';
	$text['instruct_action_database'] = 'Действия с базой данных';
	$text['instruct_action_create_dir'] = 'Создать директорию';
	$text['instruct_action_create_file'] = 'Создать файл';
	$text['instruct_action_require_dir'] = 'Установить файлы из директории';
	$text['instruct_action_require_file'] = 'Установить файл из файла';
	$text['instruct_action_move_dir'] = 'Переместить/Переименовать директорию';
	$text['instruct_action_move_file'] = 'Переместить/Переименовать файл';
	$text['instruct_action_delete_dir'] = 'Удалить директорию';
	$text['instruct_action_delete_file'] = 'Удалить файл';
	$text['instruct_action_readme'] = 'Readme (Описание)';

	$text['action_inline'] = 'Внутренняя правка';
	$text['action_reverse'] = 'Откатить изменения';
	$text['action_destination'] = 'Путь назначения';
	$text['action_source'] = 'Файл/Папка для включения';
	$text['action_code_block'] = 'Внутренний код';
	

// The Index section
	$text['index_welcome'] = 'Добро пожаловать в SMF Package Maker. Ниже три простых шага для создания вашей собственной модификации';
	$text['index_mod'] = 'Создать мод';
	$text['index_info'] = 'Создать Package-Info';
	$text['index_compress'] = 'Упаковать файл в .zip или .tgz (.tar.gz) архив';
