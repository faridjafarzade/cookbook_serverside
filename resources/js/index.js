import React, { Component } from 'react';
        import { connect } from 'react-redux'
        import * as receiptAction from '../../actions/receiptAction';
        import fetch from 'cross-fetch';
        import { withRouter } from "react-router-dom";
        import '../../assets/css/semantic.css';
        import {  Form, Button, Message} from 'semantic-ui-react'

        class Add extends Component {

        constructor(props){

        super(props);
                this.titleChange = this.titleChange.bind(this);
                this.descriptionChange = this.descriptionChange.bind(this);
                this.handleSubmit = this.handleSubmit.bind(this);
                this.state = {
                title: this.props.location.state.title,
                        description: this.props.location.state.description,
                        id: this.props.location.state.id,
                        serverError:0,
                        titleError:false,
                        descriptionError:false
                }

        }

        descriptionChange(e){

        this.setState({
        description: e.target.value,
                serverError:0,
                descriptionError:false
        })

                if (!e.target.value.match(/^[0-9A-Za-z,\ \n\.\-\/:\(\)]+$/)){
        this.setState({
        descriptionError:true,
                serverError:1000
        })
        }

        }

        titleChange(e){

        this.setState({
        title: e.target.value,
                serverError:0,
                titleError:false
        })

                if ((!e.target.validity.valid)){
        this.setState({
        titleError:true,
                serverError:1000
        })
        }

        }


        handleSubmit(e){
        e.preventDefault();
                var clone = this;
                if (!this.state.titleError && !this.state.descriptionError)
                if (this.state.title === '' || this.state.description === '')
                this.setState({
                serverError:999
                })

                else
                fetch('http://www.maskeddream.com/cookbook/apis/receipt_api.php?action=save&description=' + this.state.description + '&title=' + this.state.title + '&receipt_id=' + this.state.id).then(function(data) {
        data = JSON.parse(data._bodyInit);
                if (data.http_status_codes === 201){
        let receipt = {
        title: data.receipt.title,
                description: data.receipt.description,
                id:data.receipt.id
        }
        clone.setState({
        title: '',
                description: '',
                serverError:0
        });
                clone.props.createReceipt(receipt);
                clone.props.history.push({
                pathname: '/receiptpage',
                        state: { title: data.receipt.title, id:data.receipt.id, description:data.receipt.description}
                });
        }

        else{clone.setState({serverError:data.http_status_codes }); }


        }).catch(function(err) {
        console.log(clone.getServerMessage())
                clone.setState({
                serverError:666
            });
                });
        }



        getServerMessage(){

        if (this.state.serverError === 204)
                return < Message
                error
                header = 'Action Forbidden'
                content = 'Fill all fields !'
                />
                else if (this.state.serverError === 400)
                return < Message
                error
                header = 'Server Error'
                content = 'There is wrong something !!'
                />
                else if (this.state.serverError === 666)
                return < Message
                error
                header = 'Error'
                content = 'There is wrong something !!'
                />
                else if (this.state.serverError === 999)
                return < Message
                error
                header = 'Error'
                content = "Don't send empty fields"
                />
                else if (this.state.serverError === 1000)
                return < Message
                error
                header = 'Error'
                content = "Only letters, digits and [,],[.],[(],[)] are accepted ! "
                />
                else return ''
        }



        render() {
        var clone = this;
          return(
                        < div >
                        < h3 > Add Receipt < /h3>
                        < form onSubmit = {this.handleSubmit} >
                        < Form error >
                        < Form.Field type = "text"   pattern = "[0-9A-Za-z\s,\.\-\/:\(\)]*" error = {clone.state.titleError} value = {this.state.title} onChange = {this.titleChange} label = 'Title' control = 'input' / >
                        < Form.Field    error = {clone.state.descriptionError} value = {this.state.description} onChange = {this.descriptionChange} label = 'Description of receipt ' control = 'textarea' / >
                        < Button type = 'submit' fluid > Save < /Button>
                {clone.getServerMessage()}
                < /Form>
                        < /form>
                        < hr / >
                        < /div>

                        )
        }
        }


const mapStateToProps = (state, ownProps) = > {
return {

}
};
        const mapDispatchToProps = (dispatch) = > {
return {
createReceipt: receipt = > dispatch(receiptAction.createReceipt(receipt))
}
};
        export default withRouter(connect(
                mapStateToProps,
                mapDispatchToProps
                )(Add))

