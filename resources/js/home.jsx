import React from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios';

export default class HomeDialog extends React.Component {
  constructor(props) {
    super(props);
    this.clickStats = this.clickStats.bind(this);
    this.clickStatsMy = this.clickStatsMy.bind(this);
    this.handleClick = this.handleClick.bind(this);
    this.clickEpisodes = this.clickEpisodes.bind(this);
    this.handleEpisodeId = this.handleEpisodeId.bind(this);
    this.clickEpisodeId = this.clickEpisodeId.bind(this); 
    this.clickCharacters = this.clickCharacters.bind(this); 
    this.handleCharactersName = this.handleCharactersName.bind(this);
    this.clickCharactersName = this.clickCharactersName.bind(this); 
    this.clickCharacterRandom = this.clickCharacterRandom.bind(this); 
    this.clickQuotes = this.clickQuotes.bind(this); 
    this.handleQuotesName = this.handleQuotesName.bind(this);
    this.clickQuotesName = this.clickQuotesName.bind(this); 
    this.clickLogout = this.clickLogout.bind(this); 
    this.state = {
        res: '',
        episodeId: 1,
        charactersName: 'w',
        quotesName: 's',
    }
  }

  clickStats() {
	this.handleClick('/api/stats');
  }

  clickStatsMy() {
	this.handleClick('/api/my-stats');
  }

  clickEpisodes() {
	this.handleClick('/api/episodes');
  }

  handleEpisodeId(event) { 
    this.setState({
      episodeId: event.target.value 
    })
  }   

  clickEpisodeId(event) { 
    this.handleClick('/api/episodes/' + this.state.episodeId);
  }  

  clickCharacters() {
	this.handleClick('/api/characters');
  }   

  handleCharactersName(event) { 
    this.setState({
      charactersName: event.target.value 
    })
  }   

  clickCharactersName(event) { 
    this.handleClick('/api/characters?name=' + this.state.charactersName);
  }  

  clickCharacterRandom() {
	this.handleClick('/api/characters/random');
  } 

  clickQuotes() {
	this.handleClick('/api/quotes');
  }   

  handleQuotesName(event) { 
    this.setState({
      quotesName: event.target.value 
    })
  }   

  clickQuotesName(event) { 
    this.handleClick('/api/quotes/random?author=' + this.state.quotesName);
  }  

  async handleClick(route) { 
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.token;

    const response = await axios
     .get(route)
     .catch(res => {
         alert('There is nothing there...');
    });

    const res = await response;
    //console.log(res);
	this.setState({
       res: JSON.stringify(res.data), 
	})
  } 

  clickLogout() { 
     this.props.logout()
  }  

  render() {
    return (
	     <div>
	       <div  className="form-group row">
             <div className="col-md-8"></div>
             <div className="col-md-4">
                 <button type="button" className="btn btn-link btn-block btn-sm my-3 font-weight-normal" 
                   onClick={this.clickLogout}
                >
                Logout <span className="text-muted">{this.props.username || localStorage.username}</span>
                </button>
             </div>
           </div>
           <div  className="form-group row">  
             <div className="col-md-1"></div>
             <div className="col-md-4">
                <h3>Endpoints:</h3> 
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-success btn-block btn-sm my-3" 
		                   onClick={this.clickStats}
		                >
		                /stats
		                </button>
	                </div>
	                <div className="col-md-6">

	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-success btn-block btn-sm my-3" 
		                   onClick={this.clickStatsMy}
		                >
		                /my-stats
		                </button>
	                </div>
	                <div className="col-md-6">

	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickEpisodes}
		                >
		                /episodes
		                </button>
	                </div>
	                <div className="col-md-6">

	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickEpisodeId}
		                >
		                /episodes/&#123;id&#125;
		                </button>
	                </div>
	                <div className="col-md-6">           
                       <input id="episodeId" name="episodeId" type="text" placeholder="Episode Id" className="form-control form-control-sm my-3" value={this.state.episodeId} onChange={this.handleEpisodeId} />
	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickCharacters}
		                >
		                /characters
		                </button>
	                </div>
	                <div className="col-md-6">           

	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickCharactersName}
		                >
                        /characters?name=&#123;name&#125;
		                </button>
	                </div>
	                <div className="col-md-6">           
                       <input id="charactersName" name="charactersName" type="text" placeholder="Characters Name" className="form-control form-control-sm my-3" value={this.state.charactersName} onChange={this.handleCharactersName} />
	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickCharacterRandom}
		                >
		                /characters/random
		                </button>
	                </div>
	                <div className="col-md-6">           

	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickQuotes}
		                >
		                /quotes
		                </button>
	                </div>
	                <div className="col-md-6">           

	                </div>
                </div>
                <div  className="row">
	                <div className="col-md-6">
		                <button type="button" className="btn btn-primary btn-block btn-sm my-3" 
		                   onClick={this.clickQuotesName}
		                >
                        /quotes/random?author=&#123;character_name&#125;
		                </button>
	                </div>
	                <div className="col-md-6">           
                       <input id="quotesName" name="quotesName" type="text" placeholder="Characters Name" className="form-control form-control-sm my-3" value={this.state.quotesName} onChange={this.handleQuotesName} />
	                </div>
                </div>
             </div>
             <div className="col-md-6">
             <h3>Data:</h3>
             {this.state.res && (
	            <div>
                { this.state.res }
                </div>  
             )}
             </div>
             <div className="col-md-1"></div>
          </div>
        </div>
    );
  }
}


