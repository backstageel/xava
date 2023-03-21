/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `avenues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avenues`
(
    `id`          int unsigned NOT NULL AUTO_INCREMENT,
    `name`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `district_id` int unsigned NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `avenues_name_district_id_unique` (`name`,`district_id`),
    KEY           `avenues_district_id_foreign` (`district_id`),
    CONSTRAINT `avenues_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `civil_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `civil_states`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `civil_states_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies`
(
    `id`                      int unsigned NOT NULL AUTO_INCREMENT,
    `name`                    varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `nuel`                    int                                     DEFAULT NULL,
    `nuit`                    int                                     DEFAULT NULL,
    `date_registration`       date                                    DEFAULT NULL,
    `republic_bulletin_id`    int unsigned DEFAULT NULL,
    `company_type_id`         tinyint unsigned DEFAULT NULL,
    `share_capital`           decimal(12, 2)                          DEFAULT NULL,
    `address_avenue_id`       varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address_street_number`   varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address_neighborhood_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address_district_id`     int                                     DEFAULT NULL,
    `address_province_id`     int                                     DEFAULT NULL,
    `address_country_id`      int                                     DEFAULT NULL,
    `email`                   varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone`                   varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `website`                 varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at`              timestamp NULL DEFAULT NULL,
    `updated_at`              timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `companies_nuel_unique` (`nuel`),
    UNIQUE KEY `companies_nuit_unique` (`nuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `company_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_types`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `company_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries`
(
    `id`           tinyint unsigned NOT NULL AUTO_INCREMENT,
    `code`         varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name`         varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `continent_id` bigint unsigned DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `countries_code_unique` (`code`),
    UNIQUE KEY `countries_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_invoices`
(
    `id`               bigint unsigned NOT NULL AUTO_INCREMENT,
    `invoice_number`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `invoice_date`     date                                    NOT NULL,
    `customer_id`      int unsigned NOT NULL,
    `sale_id`          bigint unsigned NOT NULL,
    `billing_address`  varchar(255) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `total_amount`     decimal(12, 2)                          NOT NULL DEFAULT '0.00',
    `payment_method`   varchar(255) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `due_date`         date                                             DEFAULT NULL,
    `payment_status`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
    `notes`            text COLLATE utf8mb4_unicode_ci,
    `created_at`       timestamp NULL DEFAULT NULL,
    `updated_at`       timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                `customer_invoices_sale_id_foreign` (`sale_id`),
    CONSTRAINT `customer_invoices_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_statuses`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `customer_statuses_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_types`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `customer_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers`
(
    `id`                int unsigned NOT NULL AUTO_INCREMENT,
    `customerable_id`   int unsigned NOT NULL,
    `customerable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments`
(
    `id`         int unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `company_id` int unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts`
(
    `id`          int unsigned NOT NULL AUTO_INCREMENT,
    `code`        varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `name`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `province_id` int unsigned NOT NULL,
    `country_id`  tinyint unsigned NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `districts_name_province_id_unique` (`name`,`province_id`),
    KEY           `districts_province_id_foreign` (`province_id`),
    KEY           `districts_country_id_foreign` (`country_id`),
    CONSTRAINT `districts_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
    CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `employee_contract_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_contract_statuses`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `employee_contract_statuses_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `employee_contract_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_contract_types`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `employee_contract_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `employee_contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_contracts`
(
    `id`                   int unsigned NOT NULL AUTO_INCREMENT,
    `employee_id`          int unsigned NOT NULL,
    `contract_type_id`     tinyint unsigned NOT NULL,
    `start_date`           date           NOT NULL,
    `end_date`             date DEFAULT NULL,
    `base_salary`          decimal(10, 2) NOT NULL,
    `weekly_hours`         int  DEFAULT NULL,
    `benefits`             text COLLATE utf8mb4_unicode_ci,
    `contract_status_id`   tinyint unsigned NOT NULL DEFAULT '1',
    `employee_position_id` tinyint unsigned NOT NULL,
    `department_id`        int unsigned NOT NULL,
    `termination_date`     date DEFAULT NULL,
    `termination_reason`   text COLLATE utf8mb4_unicode_ci,
    `notes`                text COLLATE utf8mb4_unicode_ci,
    `created_at`           timestamp NULL DEFAULT NULL,
    `updated_at`           timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                    `employee_contracts_employee_id_foreign` (`employee_id`),
    KEY                    `employee_contracts_contract_type_id_foreign` (`contract_type_id`),
    KEY                    `employee_contracts_contract_status_id_foreign` (`contract_status_id`),
    KEY                    `employee_contracts_employee_position_id_foreign` (`employee_position_id`),
    KEY                    `employee_contracts_department_id_foreign` (`department_id`),
    CONSTRAINT `employee_contracts_contract_status_id_foreign` FOREIGN KEY (`contract_status_id`) REFERENCES `employee_contract_statuses` (`id`),
    CONSTRAINT `employee_contracts_contract_type_id_foreign` FOREIGN KEY (`contract_type_id`) REFERENCES `employee_contract_types` (`id`),
    CONSTRAINT `employee_contracts_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
    CONSTRAINT `employee_contracts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
    CONSTRAINT `employee_contracts_employee_position_id_foreign` FOREIGN KEY (`employee_position_id`) REFERENCES `employee_positions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `employee_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_positions`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `employee_positions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees`
(
    `id`                   int unsigned NOT NULL AUTO_INCREMENT,
    `employee_code`        varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `person_id`            int unsigned NOT NULL,
    `emergency_name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `emergency_phone`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `employee_position_id` tinyint unsigned NOT NULL,
    `department_id`        int unsigned NOT NULL,
    `start_date`           date                                    NOT NULL,
    `base_salary`          decimal(10, 2)                          NOT NULL,
    `contract_type_id`     tinyint unsigned NOT NULL,
    `contract_status_id`   tinyint unsigned NOT NULL DEFAULT '1',
    `created_at`           timestamp NULL DEFAULT NULL,
    `updated_at`           timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                    `employees_contract_status_id_foreign` (`contract_status_id`),
    KEY                    `employees_contract_type_id_foreign` (`contract_type_id`),
    KEY                    `employees_employee_position_id_foreign` (`employee_position_id`),
    KEY                    `employees_department_id_foreign` (`department_id`),
    CONSTRAINT `employees_contract_status_id_foreign` FOREIGN KEY (`contract_status_id`) REFERENCES `employee_contract_statuses` (`id`),
    CONSTRAINT `employees_contract_type_id_foreign` FOREIGN KEY (`contract_type_id`) REFERENCES `employee_contract_types` (`id`),
    CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
    CONSTRAINT `employees_employee_position_id_foreign` FOREIGN KEY (`employee_position_id`) REFERENCES `employee_positions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `uuid`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `queue`      text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `payload`    longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `exception`  longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `failed_at`  timestamp                               NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `genders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genders`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `genders_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `identity_document_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `identity_document_types`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `identity_document_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loans`
(
    `id`          tinyint unsigned NOT NULL AUTO_INCREMENT,
    `employee_id` int unsigned NOT NULL,
    `amount`      decimal(8, 2)                           NOT NULL,
    `months`      int                                              DEFAULT NULL,
    `total_paid`  decimal(8, 2)                           NOT NULL DEFAULT '0.00',
    `installment` decimal(8, 2)                           NOT NULL,
    `start_date`  date                                    NOT NULL,
    `end_date`    date                                    NOT NULL,
    `status`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY           `loans_employee_id_foreign` (`employee_id`),
    CONSTRAINT `loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations`
(
    `id`        int unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int                                     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions`
(
    `permission_id` bigint unsigned NOT NULL,
    `model_type`    varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `model_id`      bigint unsigned NOT NULL,
    PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
    KEY             `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
    CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles`
(
    `role_id`    bigint unsigned NOT NULL,
    `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `model_id`   bigint unsigned NOT NULL,
    PRIMARY KEY (`role_id`, `model_id`, `model_type`),
    KEY          `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
    CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `neighborhoods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `neighborhoods`
(
    `id`          int unsigned NOT NULL AUTO_INCREMENT,
    `name`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `district_id` int unsigned NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `neighborhoods_name_district_id_unique` (`name`,`district_id`),
    KEY           `neighborhoods_district_id_foreign` (`district_id`),
    CONSTRAINT `neighborhoods_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens`
(
    `email`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments`
(
    `id`     tinyint unsigned NOT NULL AUTO_INCREMENT,
    `amount` double(8, 2
) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `people`
(
    `id`                              int unsigned NOT NULL AUTO_INCREMENT,
    `user_id`                         int unsigned DEFAULT NULL,
    `person_prefix_id`                tinyint unsigned DEFAULT NULL,
    `first_name`                      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `last_name`                       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `gender_id`                       tinyint unsigned NOT NULL,
    `birth_date`                      date                                    DEFAULT NULL,
    `address`                         varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address_district_id`             int unsigned DEFAULT NULL,
    `address_province_id`             bigint unsigned DEFAULT NULL,
    `address_country_id`              int unsigned DEFAULT NULL,
    `birth_district_id`               int unsigned DEFAULT NULL,
    `birth_province_id`               bigint unsigned DEFAULT NULL,
    `birth_country_id`                int unsigned DEFAULT NULL,
    `phone`                           varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `email`                           varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `civil_state_id`                  tinyint unsigned DEFAULT NULL,
    `nuit`                            varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `identity_document_type_id`       tinyint unsigned DEFAULT NULL,
    `identity_document_number`        varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `identity_document_emission_date` date                                    DEFAULT NULL,
    `identity_document_expiry_date`   date                                    DEFAULT NULL,
    `created_at`                      timestamp NULL DEFAULT NULL,
    `updated_at`                      timestamp NULL DEFAULT NULL,
    `image_path`                      varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                               `people_gender_id_foreign` (`gender_id`),
    CONSTRAINT `people_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `person_prefixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `person_prefixes`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `code`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `person_prefixes_code_unique` (`code`),
    UNIQUE KEY `person_prefixes_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens`
(
    `id`             bigint unsigned NOT NULL AUTO_INCREMENT,
    `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tokenable_id`   bigint unsigned NOT NULL,
    `name`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`          varchar(64) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `abilities`      text COLLATE utf8mb4_unicode_ci,
    `last_used_at`   timestamp NULL DEFAULT NULL,
    `expires_at`     timestamp NULL DEFAULT NULL,
    `created_at`     timestamp NULL DEFAULT NULL,
    `updated_at`     timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY              `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products`
(
    `id`             int unsigned NOT NULL AUTO_INCREMENT,
    `name`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `reference`      varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `description`    varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `category_id`    tinyint unsigned DEFAULT NULL,
    `brand`          varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `sale_price`     decimal(10, 2) unsigned NOT NULL,
    `purchase_price` decimal(8, 2) unsigned DEFAULT NULL,
    `vat_id`         tinyint unsigned DEFAULT NULL,
    `created_at`     timestamp NULL DEFAULT NULL,
    `updated_at`     timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `products_name_unique` (`name`),
    UNIQUE KEY `products_reference_unique` (`reference`),
    UNIQUE KEY `products_description_unique` (`description`),
    KEY              `products_vat_id_foreign` (`vat_id`),
    KEY              `products_category_id_foreign` (`category_id`),
    CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`),
    CONSTRAINT `products_vat_id_foreign` FOREIGN KEY (`vat_id`) REFERENCES `vat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provinces`
(
    `id`         int unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `code`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `country_id` tinyint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `provinces_name_country_id_unique` (`name`,`country_id`),
    UNIQUE KEY `provinces_code_unique` (`code`),
    KEY          `provinces_country_id_foreign` (`country_id`),
    CONSTRAINT `provinces_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions`
(
    `permission_id` bigint unsigned NOT NULL,
    `role_id`       bigint unsigned NOT NULL,
    PRIMARY KEY (`permission_id`, `role_id`),
    KEY             `role_has_permissions_role_id_foreign` (`role_id`),
    CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
    CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sale_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale_items`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `sale_id`    int unsigned NOT NULL,
    `product_id` int unsigned NOT NULL,
    `quantity`   int            NOT NULL,
    `unit_price` decimal(12, 2) NOT NULL,
    `sub_total`  decimal(12, 2) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sale_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale_statuses`
(
    `id`         tinyint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `sale_statuses_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales`
(
    `id`             bigint unsigned NOT NULL AUTO_INCREMENT,
    `sale_ref`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `customer_id`    int unsigned NOT NULL,
    `sale_date`      date                                    NOT NULL,
    `total_amount`   decimal(12, 2)                          NOT NULL DEFAULT '0.00',
    `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `sale_status_id` tinyint unsigned NOT NULL DEFAULT '1',
    `notes`          text COLLATE utf8mb4_unicode_ci,
    `created_at`     timestamp NULL DEFAULT NULL,
    `updated_at`     timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `sales_sale_ref_unique` (`sale_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers`
(
    `id`                tinyint unsigned NOT NULL AUTO_INCREMENT,
    `supplierable_id`   int unsigned NOT NULL,
    `supplierable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telescope_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_entries`
(
    `sequence`                bigint unsigned NOT NULL AUTO_INCREMENT,
    `uuid`                    char(36) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `batch_id`                char(36) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `family_hash`             varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
    `type`                    varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `content`                 longtext COLLATE utf8mb4_unicode_ci    NOT NULL,
    `created_at`              datetime                                DEFAULT NULL,
    PRIMARY KEY (`sequence`),
    UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
    KEY                       `telescope_entries_batch_id_index` (`batch_id`),
    KEY                       `telescope_entries_family_hash_index` (`family_hash`),
    KEY                       `telescope_entries_created_at_index` (`created_at`),
    KEY                       `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telescope_entries_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_entries_tags`
(
    `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci     NOT NULL,
    `tag`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    KEY          `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
    KEY          `telescope_entries_tags_tag_index` (`tag`),
    CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telescope_monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_monitoring`
(
    `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users`
(
    `id`                int unsigned NOT NULL AUTO_INCREMENT,
    `name`              varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`             varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password`          varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token`    varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vat`
(
    `id`          tinyint unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `rate`        decimal(2, 2)                           NOT NULL,
    `type`        varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `vat_description_unique` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations`
VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations`
VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations`
VALUES (3, '2018_08_08_100000_create_telescope_entries_table', 1);
INSERT INTO `migrations`
VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations`
VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations`
VALUES (6, '2022_06_02_200350_identity_document_types', 1);
INSERT INTO `migrations`
VALUES (7, '2022_06_02_200426_genders', 1);
INSERT INTO `migrations`
VALUES (8, '2022_06_02_200457_civil_states', 1);
INSERT INTO `migrations`
VALUES (9, '2022_06_15_045430_create_companies_table', 1);
INSERT INTO `migrations`
VALUES (10, '2022_06_15_132441_create_countries_table', 1);
INSERT INTO `migrations`
VALUES (11, '2022_09_15_195356_create_provinces_table', 1);
INSERT INTO `migrations`
VALUES (12, '2022_09_15_195420_create_districts_table', 1);
INSERT INTO `migrations`
VALUES (13, '2022_09_15_195500_create_neighborhoods_table', 1);
INSERT INTO `migrations`
VALUES (14, '2022_09_15_195543_create_avenues_table', 1);
INSERT INTO `migrations`
VALUES (15, '2023_02_01_155444_create_employee_contract_types_table', 1);
INSERT INTO `migrations`
VALUES (16, '2023_02_01_155453_create_employee_contract_statuses_table', 1);
INSERT INTO `migrations`
VALUES (17, '2023_02_07_185204_create_customer_statuses_table', 1);
INSERT INTO `migrations`
VALUES (18, '2023_02_09_045946_create_sale_statuses_table', 1);
INSERT INTO `migrations`
VALUES (19, '2023_02_23_082903_create_people_table', 1);
INSERT INTO `migrations`
VALUES (20, '2023_02_27_135446_create_departments_table', 1);
INSERT INTO `migrations`
VALUES (21, '2023_02_27_135906_create_employee_positions_table', 1);
INSERT INTO `migrations`
VALUES (22, '2023_02_28_134912_create_employees_table', 1);
INSERT INTO `migrations`
VALUES (23, '2023_03_02_022844_create_person_prefixes_table', 1);
INSERT INTO `migrations`
VALUES (24, '2023_03_02_133955_create_customer_types_table', 1);
INSERT INTO `migrations`
VALUES (25, '2023_03_02_154902_create_employee_contracts_table', 1);
INSERT INTO `migrations`
VALUES (26, '2023_03_05_114852_create_customers_table', 1);
INSERT INTO `migrations`
VALUES (27, '2023_03_06_045400_create_sales_table', 1);
INSERT INTO `migrations`
VALUES (28, '2023_03_07_075604_create_permission_tables', 1);
INSERT INTO `migrations`
VALUES (29, '2023_03_07_101237_create_suppliers_table', 1);
INSERT INTO `migrations`
VALUES (30, '2023_03_07_103757_create_vat_table', 1);
INSERT INTO `migrations`
VALUES (31, '2023_03_07_195606_create_customer_invoices_table', 1);
INSERT INTO `migrations`
VALUES (32, '2023_03_07_195618_create_sale_items_table', 1);
INSERT INTO `migrations`
VALUES (33, '2023_03_08_215330_create_product_categories_table', 1);
INSERT INTO `migrations`
VALUES (34, '2023_03_09_103935_create_product_table', 1);
INSERT INTO `migrations`
VALUES (35, '2023_03_13_163615_create_company_types_table', 1);
INSERT INTO `migrations`
VALUES (36, '2023_03_18_195751_create_payments_table', 1);
INSERT INTO `migrations`
VALUES (37, '2023_03_18_195803_create_loans_table', 1);
INSERT INTO `migrations`
VALUES (38, '2023_03_21_045109_add_image_path_to_person_table', 1);
