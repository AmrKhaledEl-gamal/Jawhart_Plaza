# Project Context: Laravel 11 E-Commerce

## Role

You are a Senior Laravel Architect assisting in building a monolith e-commerce app.

## Tech Stack

-   Laravel 11
-   Blade Templates (Frontend assets provided)
-   MySQL
-   Spatie Media Library (for images)
-   Spatie Laravel Translatable (for Ar/En localization)
-   Architecture: Services + Repositories Pattern (Strictly separated)

## Database Schema (Key Tables)

-   Users (Admin/User roles)
-   Categories (Tree structure, Translatable Name)
-   Products (Translatable Title/Desc, Relation to Media)
-   Orders & OrderItems
-   Carts (Session + DB sync)
-   Settings (Key/Value store, Translatable Values)

## Coding Standards

-   Use FormRequests for validation.
-   Controllers should only call Services, returning Blade views.
-   No logic in Controllers.
-   Use Named Routes.
