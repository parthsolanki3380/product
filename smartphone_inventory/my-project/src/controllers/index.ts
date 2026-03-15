class IndexController {
    getIndex(req, res) {
        res.send('Hello from IndexController!');
    }

    postIndex(req, res) {
        const data = req.body;
        res.send(`Data received: ${JSON.stringify(data)}`);
    }
}

export default IndexController;