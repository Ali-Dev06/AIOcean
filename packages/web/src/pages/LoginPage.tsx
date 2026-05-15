import { useState, type FormEvent } from "react"
import { Link, useNavigate } from "react-router-dom"
import { useAuth } from "@/hooks/use-auth"

export function LoginPage() {
    const [email, setEmail] = useState("")
    const [password, setPassword] = useState("")
    const { login, error } = useAuth()
    const navigate = useNavigate()

    const handleSubmit = async (event: FormEvent) => {
        event.preventDefault()
        try {
            await login(email, password)
            navigate("/dashboard")
        } catch {
            // Error is handled in useAuth and displayed below.
        }
    }

    return (
        <div className="login-hero flex min-h-screen items-center justify-center px-4 py-12 text-slate-100" style={{ backgroundImage: `url('/Background.png')`, backgroundSize: 'cover', backgroundPosition: 'center', backgroundRepeat: 'no-repeat' }}>
            <div className="login-hero-overlay" aria-hidden="true" />
            <div className="login-card w-full max-w-[420px]">
                <div className="flex flex-col items-center mb-6 text-center">
                    <img src="/Trans-logo.png" alt="AI Ocean Logo" className="w-[180px] h-auto object-contain" />
                </div>

                {error && (
                    <p className="login-error" role="alert">
                        {error}
                    </p>
                )}

                <form className="mt-6 space-y-4" onSubmit={handleSubmit}>
                    <div className="login-field">
                        <label htmlFor="login-email" className="login-label">
                            Email
                        </label>
                        <input
                            id="login-email"
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
                        <label htmlFor="login-password" className="login-label">
                            Password
                        </label>
                        <input
                            id="login-password"
                            type="password"
                            autoComplete="current-password"
                            placeholder="Your password"
                            className="login-input"
                            value={password}
                            onChange={(event) => setPassword(event.target.value)}
                            required
                        />
                    </div>

                    <button type="submit" className="login-button">
                        Login
                    </button>
                </form>

                <div className="mt-4 text-center text-sm">
                    <a className="login-link" href="#">
                        Forgot Password?
                    </a>
                </div>

                <div className="mt-3 text-center text-sm text-slate-300">
                    Don&apos;t have an account?{" "}
                    <Link className="login-link" to="/signup">
                        Sign Up
                    </Link>
                </div>
            </div>
        </div>
    )
}