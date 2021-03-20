import React from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import HomeDialog from './home'
import RegisterDialog from './register'

class LoginDialog extends React.Component {
  constructor(props) {
    super(props);
    this.handleEmail = this.handleEmail.bind(this);
    this.handlePassword = this.handlePassword.bind(this);
    this.clickLogin = this.clickLogin.bind(this);
    this.clickPropsLogout = this.clickPropsLogout.bind(this);
    this.clickRegister = this.clickRegister.bind(this);
    this.clickPropsRegister = this.clickPropsRegister.bind(this);
    this.clickPropsBackLogin = this.clickPropsBackLogin.bind(this);
    this.state = {
        email: '',
        password: '',
        token: '',
        username: '',
        register: false,
    }
  }

  componentDidMount() { 
	 this.setState({
        token: localStorage.token, 
	 })
  } 

  handleEmail(event) { 
    this.setState({
      email: event.target.value 
    })
  }  

  handlePassword(event) { 
    this.setState({
      password: event.target.value 
    })
  }    

  async clickLogin() { 
	var data = {
	   email: this.state.email,
       password: this.state.password,
    };

    const response = await axios
     .post('api/login', data)
     .catch(res => {
         //console.log(res.message); 	
         //alert(res.message);
         alert('You cannot sign with those credentials');
    });

    const res = await response;
    console.log(res);
    if (res.data.token) {
		this.setState({
	       token: res.data.token,
           username: res.data.username, 
		})
		localStorage.token = res.data.token
		localStorage.username = res.data.username
	}
  } 

  clickPropsLogout() { 
     localStorage.token = ''
     localStorage.username = ''
	 this.setState({
		email: '',
		password: '',
        token: '', 
        username: '', 
        register: false,
	 })
  }

  clickRegister() { 
	 this.setState({
		register: true,
	 })
  }  

  clickPropsRegister(token, username) { 
     localStorage.token = token
     localStorage.username = username
	 this.setState({
        token: token, 
        username: username,
        register: false,
	 })
  }    

  clickPropsBackLogin() { 
	 this.setState({
        register: false,
	 })
  }  

  render() {
    return (
	  <div>
	  {! this.state.token && ! this.state.register && (
	  <div className="login-form">
        <h2 className="text-center">Log in</h2>       
        <div className="form-group">
            <input id="email" type="email" className="form-control" name="email" placeholder="Useremail" required autoComplete="email" 
             value={this.state.email} 
             onChange={this.handleEmail}
            />
        </div>
        <div className="form-group">
            <input id="password" type="password" className="form-control" name="password" placeholder="Password" required autoComplete="current-password" 
             value={this.state.password} 
             onChange={this.handlePassword}
            />
        </div>
        <div className="form-group">
            <button type="button" className="btn btn-primary btn-block"
             onClick={this.clickLogin}
            >
               Log in
            </button>
        </div> 
        <div className="form-group">
            <button type="button" className="btn btn-success btn-block"
             onClick={this.clickRegister}
            >
               Register
            </button>
        </div> 
      </div>  
      )}
      {this.state.token && (
	  <div>
        <HomeDialog token={this.state.token} username={this.state.username} logout={this.clickPropsLogout} />
      </div>  
      )} 
      {this.state.register && (
	  <div>
        <RegisterDialog register={this.clickPropsRegister} username={this.state.username} backlogin={this.clickPropsBackLogin} />
      </div>  
      )} 
      </div>
    );
  }
}

const elem = document.querySelector('#app-login') 

if (elem) {
  ReactDOM.render(<LoginDialog />, elem)
}

