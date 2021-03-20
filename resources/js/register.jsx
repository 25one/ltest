import React from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

export default class RegisterDialog extends React.Component {
  constructor(props) {
    super(props);
    this.handleName = this.handleName.bind(this);
    this.handleEmail = this.handleEmail.bind(this);
    this.handlePassword = this.handlePassword.bind(this);
    this.handlePasswordConfirmation = this.handlePasswordConfirmation.bind(this);
    this.clickRegister = this.clickRegister.bind(this);
    this.clickBackLogin = this.clickBackLogin.bind(this);
    this.state = {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    }
  }

  handleName(event) { 
    this.setState({
      name: event.target.value 
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

  handlePasswordConfirmation(event) { 
    this.setState({
      password_confirmation: event.target.value 
    })
  }

  async clickRegister() { 
	var data = {
	   name: this.state.name,	
	   email: this.state.email,
       password: this.state.password,
       password_confirmation: this.state.password_confirmation,
    };

    const response = await axios
     .post('api/register', data)
     .catch(res => {
         console.log(res); 	
         //alert(res.message);
    });

    const res = await response;
    console.log(res);
    if (res.data.token) {
        this.props.register(res.data.token, res.data.username)
	} else {
	  var errors = ''	
	  for (var i in res.data) {
	     errors += res.data[i] + '\n';	
	  }	
      alert(errors);
	}
  } 

  clickBackLogin() { 
     this.props.backlogin()
  }

  render() {
    return (
		<div className="signup-form">
			<h2>Register</h2>
	        <div className="form-group">
				<div className="row">
					<div className="col">
	                    <input id="name" type="text" className="form-control" name="name" placeholder="Name" required autoComplete="name" 
			             value={this.state.name} 
			             onChange={this.handleName}
                        />
					</div>
				</div>        	
	        </div>
	        <div className="form-group">
	            <input id="email" type="email" className="form-control" name="email" placeholder="Email" required autoComplete="email" 
			     value={this.state.email} 
			     onChange={this.handleEmail}
                />
	        </div>
			<div className="form-group">
	            <input id="password" type="password" className="form-control" name="password" placeholder="Password" required autoComplete="new-password" 
			     value={this.state.password} 
			     onChange={this.handlePassword}
                />
	        </div>
			<div className="form-group">
	            <input id="password-confirm" type="password" className="form-control" name="password_confirmation" placeholder="Confirm Password" required autoComplete="new-password" 
			     value={this.state.password_confirmation} 
			     onChange={this.handlePasswordConfirmation}
                />		
	        </div>        
			<div className="form-group">	
	            <button type="button" className="btn btn-success btn-lg btn-block"
                 onClick={this.clickRegister}
                >
                Register Now
                </button>
	        </div>
			<div className="form-group">	
	            <button type="button" className="btn btn-link btn-lg btn-block font-weight-normal"
                 onClick={this.clickBackLogin}
                >
                Back to Login
                </button>
	        </div>
		</div>
    );
  }
}
