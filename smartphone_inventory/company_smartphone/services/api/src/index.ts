import express from 'express';
import bodyParser from 'body-parser';
import phonesRoutes from './routes/phones';

const app = express();
const PORT = process.env.PORT || 3000;

app.use(bodyParser.json());
app.use('/api/phones', phonesRoutes);

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});