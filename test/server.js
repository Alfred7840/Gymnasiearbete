// server.js

const WebSocket = require('ws');
const http = require('http');

const server = http.createServer((req, res) => {
    res.writeHead(200, { 'Content-Type': 'text/plain' });
    res.end('WebSocket server is running.');
});

const wss = new WebSocket.Server({ server });

wss.on('connection', (ws) => {
    console.log('A new client has connected.');

    ws.on('message', (message) => {
        console.log(`Received: ${message}`);

        wss.clients.forEach((client) => {
            if (client !== ws && client.readyState === WebSocket.OPEN) {
                console.log('APAPAP0');
                client.send(message.toString());
            }
        });
    });

    ws.on('close', () => {
        console.log('A client has disconnected.');
        
    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`WebSocket server is listening on port ${PORT}`);
});
