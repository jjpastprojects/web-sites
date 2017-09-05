<?php

namespace Lembarek\Core\Role;

class Role
{

        public static  $roles = [
            [ 'name' =>'owner', 'order' => 3],
            [ 'name' =>'admin', 'order' => 2],
            [ 'name' =>'developper', 'order' => 1],
            [ 'name' =>'designer', 'order' => 1],
            [ 'name' =>'user', 'order' => 0],
        ];


        public static function  rolesWithPermissions(){

            return [
                'owner' => array_keys(static::permissionsForOwner()),
                'admin' => array_keys(static::permissionsForAdmin()),
                'user' => [],
            ];

        }


        public static function allPermissions(){
            return array_merge(static::$justForOwner, static::$justForAdmin, static::$permissions);
        }
        public static function permissionsForOwner(){
            return array_merge(static::$justForOwner, static::$justForAdmin, static::$permissions);
        }

        public static function permissionsForAdmin(){
            return array_merge(static::$justForAdmin, static::$permissions);
        }

        public static $justForOwner = [
            "create-onwer" => "Create owner",
            "edit-onwer" => "Edit owner",
            "destroy-onwer" => "Destroy owner",
            "none-onwer" => "None owner",
            "create-admin" => "Create admin",
            "edit-admin" => "Edit admin",
            "destroy-admin" => "Destroy admin",
            "none-admin" => "None admin",
        ];

        public static $justForAdmin  = [
            "access-backend" => "Access backend",
            "read-roles" => "Read roles",
            "create-roles" => "Create roles",
            "edit-roles" => "Edit roles",
            "destroy-roles" => "Destroy roles",
            "none-roles" => "None roles",
            "read-permissions" => "Read permissions",
            "create-permissions" => "Create permissions",
            "edit-permissions" => "Edit permissions",
            "destroy-permissions" => "Destroy permissions",
            "none-permissions" => "None permissions",
            "read-users" => "Read users",
            "create-users" => "Create users",
            "edit-users" => "Edit users",
            "destroy-users" => "Destroy users",
            "none-users" => "None users",
        ];


        public static  $permissions = [
        "read-pages" => "Read pages",
        "create-pages" => "Create pages",
        "edit-pages" => "Edit pages",
        "destroy-pages" => "Destroy pages",
        "none-pages" => "None pages",
        "read-translations" => "Read translations",
        "create-translations" => "Create translations",
        "edit-translations" => "Edit translations",
        "destroy-translations" => "Destroy translations",
        "none-translations" => "None translations",
        "read-setup-boxes-ratings" => "Read setup-boxes-ratings",
        "create-setup-boxes-ratings" => "Create setup-boxes-ratings",
        "edit-setup-boxes-ratings" => "Edit setup-boxes-ratings",
        "destroy-setup-boxes-ratings" => "Destroy setup-boxes-ratings",
        "none-setup-boxes-ratings" => "None setup-boxes-ratings",
        "read-setup-boxes-images" => "Read setup-boxes-images",
        "create-setup-boxes-images" => "Create setup-boxes-images",
        "edit-setup-boxes-images" => "Edit setup-boxes-images",
        "destroy-setup-boxes-images" => "Destroy setup-boxes-images",
        "none-setup-boxes-images" => "None setup-boxes-images",
        "read-setup-boxes" => "Read setup-boxes",
        "create-setup-boxes" => "Create setup-boxes",
        "edit-setup-boxes" => "Edit setup-boxes",
        "destroy-setup-boxes" => "Destroy setup-boxes",
        "none-setup-boxes" => "None setup-boxes",
        "read-setup-products-ratings" => "Read setup-products-ratings",
        "create-setup-products-ratings" => "Create setup-products-ratings",
        "edit-setup-products-ratings" => "Edit setup-products-ratings",
        "destroy-setup-products-ratings" => "Destroy setup-products-ratings",
        "none-setup-products-ratings" => "None setup-products-ratings",
        "read-setup-products-images" => "Read setup-products-images",
        "create-setup-products-images" => "Create setup-products-images",
        "edit-setup-products-images" => "Edit setup-products-images",
        "destroy-setup-products-images" => "Destroy setup-products-images",
        "none-setup-products-images" => "None setup-products-images",
        "read-setup-products" => "Read setup-products",
        "create-setup-products" => "Create setup-products",
        "edit-setup-products" => "Edit setup-products",
        "destroy-setup-products" => "Destroy setup-products",
        "none-setup-products" => "None setup-products",
        "read-setup-tags" => "Read setup-tags",
        "create-setup-tags" => "Create setup-tags",
        "edit-setup-tags" => "Edit setup-tags",
        "destroy-setup-tags" => "Destroy setup-tags",
        "none-setup-tags" => "None setup-tags",
        "read-setup-contracts" => "Read setup-contracts",
        "create-setup-contracts" => "Create setup-contracts",
        "edit-setup-contracts" => "Edit setup-contracts",
        "destroy-setup-contracts" => "Destroy setup-contracts",
        "none-setup-contracts" => "None setup-contracts",
        "read-setup-coupons" => "Read setup-coupons",
        "create-setup-coupons" => "Create setup-coupons",
        "edit-setup-coupons" => "Edit setup-coupons",
        "destroy-setup-coupons" => "Destroy setup-coupons",
        "none-setup-coupons" => "None setup-coupons",
        "read-setup-emails" => "Read setup-emails",
        "create-setup-emails" => "Create setup-emails",
        "edit-setup-emails" => "Edit setup-emails",
        "destroy-setup-emails" => "Destroy setup-emails",
        "none-setup-emails" => "None setup-emails",
        "read-clients-clients-boxes" => "Read clients-clients-boxes",
        "create-clients-clients-boxes" => "Create clients-clients-boxes",
        "edit-clients-clients-boxes" => "Edit clients-clients-boxes",
        "destroy-clients-clients-boxes" => "Destroy clients-clients-boxes",
        "none-clients-clients-boxes" => "None clients-clients-boxes",
        "read-clients-clients-ratings" => "Read clients-clients-ratings",
        "create-clients-clients-ratings" => "Create clients-clients-ratings",
        "edit-clients-clients-ratings" => "Edit clients-clients-ratings",
        "destroy-clients-clients-ratings" => "Destroy clients-clients-ratings",
        "none-clients-clients-ratings" => "None clients-clients-ratings",
        "read-clients-clients" => "Read clients-clients",
        "create-clients-clients" => "Create clients-clients",
        "edit-clients-clients" => "Edit clients-clients",
        "destroy-clients-clients" => "Destroy clients-clients",
        "none-clients-clients" => "None clients-clients",
        "read-clients-ratings" => "Read clients-ratings",
        "create-clients-ratings" => "Create clients-ratings",
        "edit-clients-ratings" => "Edit clients-ratings",
        "destroy-clients-ratings" => "Destroy clients-ratings",
        "none-clients-ratings" => "None clients-ratings",
        "read-taggables" => "Read taggables",
        "create-taggables" => "Create taggables",
        "edit-taggables" => "Edit taggables",
        "destroy-taggables" => "Destroy taggables",
        "none-taggables" => "None taggables",
        "read-posts" => "Read posts",
        "create-posts" => "Create posts",
        "edit-posts" => "Edit posts",
        "destroy-posts" => "Destroy posts",
        "none-posts" => "None posts",
    ];

}
