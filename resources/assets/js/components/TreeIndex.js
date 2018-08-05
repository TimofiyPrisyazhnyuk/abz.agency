import ReactDOM from "react-dom";
import React, {Component} from 'react';
import SortableTree from 'react-sortable-tree';
import 'react-sortable-tree/style.css'; // This only needs to be imported once in your app
import axios from 'axios';

let token = document.querySelector('meta[name="csrf-token"').getAttribute('content');

export default class Tree extends Component {
    constructor(props) {
        super(props);
        this.state = {
            treeData: [
                // { title: 'Chicken', children: [{ title: 'Egg' },{ title: 'Egg1' },{ title: 'Egg2' }] }
            ]
        };
        this.getTreeUsers()
    }

    getTreeUsers() {
        axios.post('/staff_tree', {
                headers: {
                    'X-CSRF-TOKEN': token
                },
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify({})
            }
        ).then(response => {
            console.log(response.data[0]);
            this.setState({
                treeData: [{
                    title: response.data[0].parent_users.first_name,
                    children: Tree.getChildren(response.data),
                }]
            });
        }).catch(function (error) {
            console.log(error);
        })
    }

    /**
     *
     * @param data
     * @returns {Array}
     */
     static getChildren(data) {
        const childrenItems = [];
        for (let i = 0; i < data.length; i++) {
            childrenItems.push({title: data[i].child_users.first_name});
        }
        // console.log(childrenItems);
        return childrenItems;
    }


    render() {
        return (
            <div style={{height: 500}}>
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
