# Laravel Simple Blog API

## About This Project

This project is a **Simple Blog API** built with **Laravel**, focusing on providing a clean and modular architecture for managing **users**, **posts**, and **comments**. Designed with scalability and maintainability in mind, the API adheres to **Domain-Driven Design (DDD)** principles, a **Layered Architecture**, and follows the **SOLID** principles to ensure high-quality code and ease of extension.

## Features

- **Users Management**: Create, retrieve, and manage users.
- **Blog Posts**: CRUD operations for posts, including scheduling or publishing control.
- **Comments**: Associate comments with posts and retrieve them efficiently.
- **Layered Architecture**: Separates responsibilities into distinct layers:
    - **Presentation**: API controllers and routes for handling HTTP requests.
    - **Application**: Command/Query separation, service orchestration, and use cases.
    - **Domain**: Core business logic and domain models.
    - **Infrastructure**: Database repositories, external integrations, and data persistence.
- **Command Query Separation (CQS)**: Clear distinction between commands (write operations) and queries (read operations).
- **RESTful API Design**: Clean and intuitive endpoints for seamless frontend integration.

## Key Principles

1. **Domain-Driven Design (DDD)**: Each feature is encapsulated within a bounded context, focusing on the core domain logic.
2. **SOLID Principles**: Adheres to software design principles to enhance reusability, maintainability, and scalability.
3. **Layered Architecture**: Decouples application layers to improve modularity and simplify testing.
4. **Command Query Separation (CQS)**: Ensures write and read concerns are handled independently for better clarity and performance.
5. **Testability**: The architecture is designed to enable isolated testing of each layer.

## Tech Stack

- **Laravel**: Backend framework.
- **MySQL**: Database.
- **Docker**: Containerization for development and deployment.
- **PHPUnit**: Testing framework.

### Installation Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/salorozco/laravel-app.git
   cd laravel-app
