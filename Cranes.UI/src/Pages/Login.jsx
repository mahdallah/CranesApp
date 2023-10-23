import React from 'react'
// import logo from '../assets/images/logo.png'

const Login = () => {
    return (
        <div className="login container">
            <div className="row vh-100 align-items-center justify-content-center">
                <div className="col-sm-8 col-md-6 col-lg-4 bg-white rounded p-4 shadow">
                    <div className="row justify-content-center mb-4">
                        {/* <img src={logo} alt="Rasmi logo" className="w-25" /> */}
                    </div>
                    <form action="">
                        <div className="mb-4">
                            <label for="email" className="form-label">Email Adderess</label>
                            <input type="email" id="email" className="form-control" autofocus aria-describedby="emailHelp" />
                            <div className="emailHelp form-text">We'll never share your email</div>
                        </div>
                        <div className="mb-4">
                            <label for="password" className="form-label">Password Adderess</label>
                            <input type="password" id="password" className="form-control" aria-describedby="passwordHelp" />
                            <div className="passwordHelp form-text">Password must be over 6 charectors long.</div>
                        </div>
                        <div className="mb-4 from-check">
                            <input type="checkbox" id="remeber" className="form-check-input" />
                            <label for="remeber" className="form-check-label">Remember Me</label>
                        </div>
                        <button type="submit" className="btn btn-warning w-100">Log in</button>
                    </form>
                    <p className="mb-0 text-center">Not registered yet? <a href="/Account/Register" className="text-decoration-none">Sign up here</a></p>
                </div>
            </div>
        </div>
    )
}

export default Login