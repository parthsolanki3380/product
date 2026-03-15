import { Router } from 'express';

const router = Router();

// Sample data for demonstration purposes
let phones = [
    { id: 1, brand: 'Brand A', model: 'Model A1' },
    { id: 2, brand: 'Brand B', model: 'Model B1' },
];

// Get all phones
router.get('/', (req, res) => {
    res.json(phones);
});

// Get a phone by ID
router.get('/:id', (req, res) => {
    const phone = phones.find(p => p.id === parseInt(req.params.id));
    if (!phone) return res.status(404).send('Phone not found');
    res.json(phone);
});

// Create a new phone
router.post('/', (req, res) => {
    const { brand, model } = req.body;
    const newPhone = { id: phones.length + 1, brand, model };
    phones.push(newPhone);
    res.status(201).json(newPhone);
});

// Update a phone by ID
router.put('/:id', (req, res) => {
    const phone = phones.find(p => p.id === parseInt(req.params.id));
    if (!phone) return res.status(404).send('Phone not found');

    const { brand, model } = req.body;
    phone.brand = brand;
    phone.model = model;
    res.json(phone);
});

// Delete a phone by ID
router.delete('/:id', (req, res) => {
    const phoneIndex = phones.findIndex(p => p.id === parseInt(req.params.id));
    if (phoneIndex === -1) return res.status(404).send('Phone not found');

    phones.splice(phoneIndex, 1);
    res.status(204).send();
});

export default router;