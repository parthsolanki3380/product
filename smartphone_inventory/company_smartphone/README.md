# company_smartphone

## Overview
This project is a comprehensive smartphone application that includes both web and mobile platforms, along with an API service and a shared UI library. 

## Project Structure
The project is organized into the following main directories:

- **apps**: Contains the web and mobile applications.
  - **web**: The web application built with React.
  - **mobile**: The mobile application built with React Native.
  
- **services**: Contains the API service for handling data and requests.
  - **api**: The backend service that manages phone data.

- **libs**: Contains shared libraries and components.
  - **ui**: A library of UI components that can be used across both web and mobile applications.

## Getting Started

### Prerequisites
- Node.js (version 14 or higher)
- npm (Node Package Manager)

### Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   cd company_smartphone
   ```

2. Install dependencies for the entire project:
   ```
   npm install
   ```

### Running the Applications

#### Web Application
To start the web application, navigate to the `apps/web` directory and run:
```
npm start
```

#### Mobile Application
To start the mobile application, navigate to the `apps/mobile` directory and run:
```
npm start
```

### API Service
To run the API service, navigate to the `services/api` directory and run:
```
npm start
```

## Usage
- The web application provides a user interface for browsing and managing smartphone data.
- The mobile application offers a similar experience optimized for mobile devices.
- The API service handles all data requests and CRUD operations for managing phone records.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.