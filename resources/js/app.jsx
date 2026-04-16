import './bootstrap';
import '../css/app.css';

import React from 'react';
import ReactDOM from 'react-dom/client';

function App() {
    return (
        <div style={{ padding: '2rem' }}>
            <h1>Quiz App</h1>
            <p>React is working.</p>
        </div>
    );
}

ReactDOM.createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);