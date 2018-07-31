import ReactDOM from "react-dom";
import React, {Component} from 'react';
import SortableTree from 'react-sortable-tree';
import 'react-sortable-tree/style.css'; // This only needs to be imported once in your app
import axios from 'axios';

let token = document.querySelector('meta[name="csrf-token"').getAttribute('content');
console.log(token);

export default class Tree extends Component {
    constructor(props) {
        super(props);
        this.state = {treeData: []};
        this.getTreeUsers()
    }

    getTreeUsers () {
        axios.post('/staff_tree', {
                headers: {
                    'X-CSRF-TOKEN': token
                },
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify({})
            }
        ).then(response => {
            console.log(response.data);
            this.setState({treeData: [response.data]});
        }).catch(function (error) {
            console.log(error);
        })
    }

    render() {
        return (
            <div style={{height: 400}}>
                <SortableTree
                    treeData={this.state.treeData}
                    onChange={treeData => this.setState({treeData})}
                />
            </div>
        );
    }
}


ReactDOM.render(
    <Tree/>,
    document.getElementById('example')
);
//{ title: 'Chicken', children: [{ title: 'Egg' }] },
//                 { title: 'Chicken', children: [{ title: 'Egg' }] },
//                 { title: 'Chicken', children: [{ title: 'Egg' }] }
