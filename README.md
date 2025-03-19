# Laravel-Vue Admin Dashboard

This project is a full-stack web application using Laravel 12 and Vue 3 (with Vite) that features an Admin Dashboard, authentication, and a complete Product management system with CRUD functionality. The dashboard layout (including a sidebar) resembles the AdminLTE v3 theme using Bootstrap 5 for styling.

## Features

- **Admin Dashboard**
  - Sidebar navigation and content area resembling AdminLTE
  - Dashboard overview page

- **Authentication**
  - Laravel’s default authentication (with a customized login to accept username or email)
  - “Remember me” functionality for indefinite login
  - Default admin user seeded via Laravel Seeder

- **Product Management**
  - Product model with Name, Category, Description, and Date & Time
  - Products seeded using Laravel factories and seeders
  - API endpoints for product CRUD operations with server-side pagination
  - Keyword search (in Name and Description) and filtering by predefined category
  - Multi-step form for creating/editing products:
    - **Step 1:** Enter Name, select Category (dropdown with predefined options), and provide a Description (HTML editor integration; a textarea is used as a placeholder)
    - **Step 2:** Upload multiple Images (stored in a separate `product_images` table)
    - **Step 3:** Select Date and Time
  - Edit and delete product functionalities

- **Frontend SPA**
  - Built with Vue 3 and Vue Router
  - Vite as the build tool for a modern development experience

- **Database**
  - Uses MySQL (configured via local phpMyAdmin)

## Installation Guide

### Prerequisites

- PHP (>= 8.1)
- Composer
- Node.js and npm
- MySQL (with phpMyAdmin available locally)

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
