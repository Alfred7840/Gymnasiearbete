// server.js

const WebSocket = require('ws');
const http = require('http');

// Skapa HTTP-server för att hantera WebSocket-anslutningar
const server = http.createServer((req, res) => {
    res.writeHead(200, { 'Content-Type': 'text/plain' });
    res.end('WebSocket server is running.');
});

const wss = new WebSocket.Server({ server });

// Hantera anslutningar från klienter
wss.on('connection', (ws) => {
    console.log('A new client has connected.');

    ws.on('message', (message) => {
        console.log(`Received: ${message}`);
        const data = JSON.parse(message);

        // Skicka vidare meddelandet till alla andra klienter
        wss.clients.forEach((client) => {
            if (client !== ws && client.readyState === WebSocket.OPEN) {
                client.send(JSON.stringify(data));
            }
        });
    });

    ws.on('close', () => {
        console.log('A client has disconnected.');
    });
});

// Starta servern på angiven port
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`WebSocket server is listening on port ${PORT}`);
});
