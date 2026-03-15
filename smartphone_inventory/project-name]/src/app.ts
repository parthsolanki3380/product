import express from 'express';
import { MyType } from './types/index';

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware setup
app.use(express.json());

// Main application logic
app.get('/', (req, res) => {
    res.send('Hello, World!');
});

// Example of using a type
const exampleFunction = (data: MyType) => {
    console.log(data);
};

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});