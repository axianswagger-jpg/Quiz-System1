import React, { useState } from "react";
import { createBrowserRouter } from "react-router-dom";
import type { Quiz, Question } from "./types/quiz";

type RouterDeps = {
  quizzes: Quiz[];
  isLoggedIn: boolean;
  username: string | null;
  onLogin: (u: string, p: string) => boolean;
  onLogout: () => void;
  onCreateQuiz: (title: string, description: string, questions: Question[]) => void;
};

export function createAppRouter(deps: RouterDeps) {
  return createBrowserRouter([
    { path: "/", element: <HomePage {...deps} /> },
    { path: "/login", element: <LoginPage {...deps} /> },
  ]);
}

function HomePage({ quizzes, isLoggedIn, username, onLogout }: RouterDeps) {
  return (
    <div style={{ padding: 24, fontFamily: "system-ui" }}>
      <h1>Quiz System</h1>

      {isLoggedIn ? (
        <div style={{ marginTop: 8 }}>
          <p>Welcome, {username}!</p>
          <button onClick={onLogout}>Logout</button>
        </div>
      ) : (
        <p style={{ marginTop: 8 }}>Not logged in. Visit /login</p>
      )}

      <h2 style={{ marginTop: 16 }}>Quizzes</h2>
      <ul>
        {quizzes.map((q) => (
          <li key={q.id}>
            <strong>{q.title}</strong> — {q.description}
          </li>
        ))}
      </ul>
    </div>
  );
}

function LoginPage({ onLogin }: RouterDeps) {
  const [u, setU] = useState("");
  const [p, setP] = useState("");
  const [error, setError] = useState<string | null>(null);

  return (
    <div style={{ padding: 24, fontFamily: "system-ui" }}>
      <h1>Login</h1>

      <div style={{ display: "grid", gap: 8, maxWidth: 320 }}>
        <input placeholder="Username" value={u} onChange={(e) => setU(e.target.value)} />
        <input placeholder="Password" type="password" value={p} onChange={(e) => setP(e.target.value)} />

        <button
          onClick={() => {
            const ok = onLogin(u, p);
            setError(ok ? null : "Wrong password for existing username.");
          }}
        >
          Login / Register
        </button>

        {error && <p style={{ color: "red" }}>{error}</p>}
        <p>Go back to / after login</p>
      </div>
    </div>
  );
}
