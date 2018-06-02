import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter as Router, Route, NavLink } from 'react-router-dom'
import { Button } from 'reactstrap'

const DashboardHome = () => (
  <div>
    <div className="card-header">Dashboard Home</div>
    <div className="card-body">
      Some quick example text to build on the card title and make up the bulk of
      the card's content.
    </div>
  </div>
)

const ChangePassword = () => (
  <div>
    <div className="card-header">Change Password</div>
    <div className="card-body">
      Some quick example text to build on the card title and make up the bulk of
      the card's content.
    </div>
  </div>
)

const AccountProfile = () => (
  <div>
    <div className="card-header">Profile</div>
    <div className="card-body">
      Some quick example text to build on the card title and make up the bulk of
      the card's content.
    </div>
  </div>
)

export default class Dashboard extends Component {
  logout() {
    window.axios.post(this.props.laravel.routes.logout)
  }

  render() {
    return (
      <Router basename="/dashboard">
        <div>
          <nav
            className="navbar navbar-expand-lg navbar-light mb-3 navbar-laravel"
            style={{ backgroundColor: 'white' }}
          >
            <div className="container">
              <a className="navbar-brand" href={this.props.laravel.routes.home}>
                LaravelSaas
              </a>

              <div
                className="collapse navbar-collapse"
                id="navbarSupportedContent"
              >
                <ul className="navbar-nav mr-auto" />

                <ul className="navbar-nav ml-auto">
                  <li className="nav-item dropdown">
                    <a id="navbarDropdown" className="nav-link" href="#">
                      {this.props.laravel.user.name}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

          <div className="container">
            <div className="row">
              <div className="col-3">
                <aside>
                  <h3 className="nav-heading">Dashboard</h3>
                  <ul className="nav flex-column mb-4">
                    <li className="nav-item">
                      <NavLink exact className="nav-link" to="/">
                        Link 1
                      </NavLink>
                    </li>
                    <li className="nav-item">
                      <NavLink className="nav-link" to="/link2">
                        Link 2
                      </NavLink>
                    </li>
                    <li className="nav-item">
                      <NavLink className="nav-link" to="/link3">
                        Link 3
                      </NavLink>
                    </li>
                  </ul>

                  <h3 className="nav-heading">Account</h3>
                  <ul className="nav flex-column mb-4">
                    <li className="nav-item">
                      <NavLink exact className="nav-link" to="/account/profile">
                        Profile
                      </NavLink>
                    </li>
                    <li className="nav-item">
                      <NavLink
                        className="nav-link"
                        to="/account/change-password"
                      >
                        Change Password
                      </NavLink>
                    </li>
                    <li className="nav-item">
                      <NavLink className="nav-link" to="/account/billing">
                        Billing
                      </NavLink>
                    </li>
                  </ul>
                </aside>
              </div>
              <div className="col-9">
                <div className="card border-0">
                  <Route
                    exact
                    path="/"
                    render={() => (
                      <DashboardHome laravel={this.props.laravel} />
                    )}
                  />
                  <Route
                    exact
                    path="/account/profile"
                    component={AccountProfile}
                  />
                  <Route
                    exact
                    path="/account/change-password"
                    component={ChangePassword}
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </Router>
    )
  }
}

if (document.getElementById('app')) {
  ReactDOM.render(
    <Dashboard laravel={window.Laravel} />,
    document.getElementById('app')
  )
}
