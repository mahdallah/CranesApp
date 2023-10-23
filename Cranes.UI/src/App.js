import React from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'

import Sidebar from './components/Sidebar'
import Footer from './components/Footer'

import Register from './Pages/Register'
import Login from './Pages/Login'
import Home from './Pages/Home'
import Profile from './Pages/Profile'
import Customers from './Pages/Customers'
import Create_Customer from './Pages/Create_Customer'

const App = () => {
    return (
        <Router>
            <Sidebar />
            <Routes>
                <Route path='/Account/Register' element={<Register />} />
                <Route path='/Account/Login' element={<Login />} />
                <Route path='/' element={<Home />} />
                <Route path='/Manage/' element={<Profile />} />
                <Route path='/Customers/' element={<Customers />} />
                <Route path='/Customers/Create' element={<Create_Customer />} />
            </Routes>
            <Footer/>
        </Router>
    )
}

export default App