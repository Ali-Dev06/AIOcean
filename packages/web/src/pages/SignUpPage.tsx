import { useState, type FormEvent } from "react"
import { Link } from "react-router-dom"

export function SignUpPage() {
  const [name, setName] = useState("")
  const [email, setEmail] = useState("")
  const [password, setPassword] = useState("")
  const [confirmPassword, setConfirmPassword] = useState("")
  const [error, setError] = useState<string | null>(null)

  const handleSubmit = (event: FormEvent) => {
    event.preventDefault()
    if (password !== confirmPassword) {
      setError("Passwords do not match.")
      return
    }
    setError(null)
  }

  return (
    <div className="login-hero flex min-h-screen items-center justify-center px-4 py-12 text-slate-100" style={{ backgroundImage: `url('/Background.png')`, backgroundSize: 'cover', backgroundPosition: 'center', backgroundRepeat: 'no-repeat' }}>
      <div className="login-hero-overlay" aria-hidden="true" />

      <div className="login-card w-full max-w-[420px]">
        <div className="flex flex-col items-center mb-6 text-center">
            <img src="/Trans-logo.png" alt="AI Ocean Logo" className="w-[180px] h-auto object-contain" />
            <p className="mt-2 text-sm text-slate-300">Create your account</p>
        </div>

        {error && (
          <p className="login-error" role="alert">
            {error}
          </p>
        )}

        <form className="mt-6 space-y-4" onSubmit={handleSubmit}>
          <div className="login-field">
            <label htmlFor="signup-name" className="login-label">
              Full Name
            </label>
            <input
              id="signup-name"
              type="text"
              autoComplete="name"
              placeholder="Your name"
              className="login-input"
              value={name}
              onChange={(event) => setName(event.target.value)}
              required
            />
          </div>

          <div className="login-field">
            <label htmlFor="signup-email" className="login-label">
              Email
            </label>
            <input
              id="signup-email"
              type="email"
              autoComplete="email"
              placeholder="you@example.com"
              className="login-input"
              value={email}
              onChange={(event) => setEmail(event.target.value)}
              required
            />
          </div>

          <div className="login-field">
            <label htmlFor="signup-password" className="login-label">
              Password
            </label>
            <input
              id="signup-password"
              type="password"
              autoComplete="new-password"
              placeholder="Create a password"
              className="login-input"
              value={password}
              onChange={(event) => setPassword(event.target.value)}
              required
            />
          </div>

          <div className="login-field">
            <label htmlFor="signup-confirm" className="login-label">
              Confirm Password
            </label>
            <input
              id="signup-confirm"
              type="password"
              autoComplete="new-password"
              placeholder="Repeat your password"
              className="login-input"
              value={confirmPassword}
              onChange={(event) => setConfirmPassword(event.target.value)}
              required
            />
          </div>

          <button type="submit" className="login-button">
            Sign Up
          </button>
        </form>

        <div className="mt-4 text-center text-sm text-slate-300">
          Already have an account?{" "}
          <Link className="login-link" to="/login">
            Sign In
          </Link>
        </div>
      </div>
    </div>
  )
}
