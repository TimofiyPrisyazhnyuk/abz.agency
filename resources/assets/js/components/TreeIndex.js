import ReactDOM from "react-dom";
import React, {Component} from 'react';
import SortableTree from 'react-sortable-tree';
import 'react-sortable-tree/style.css';
import axios from 'axios';
import {addNodeUnderParent} from 'react-sortable-tree';


/**
 *
 * @type {string | null}
 */
const token = document.querySelector('meta[name="csrf-token"').getAttribute('content');

export default class Tree extends Component {
    constructor(props) {
        super(props);
        this.state = {
            treeData: []
        };
        this.getTreeUsers()
    }


    /**
     * Get tree users from database
     */
    getTreeUsers() {
        axios.post('/staff_tree', {
                headers: {'X-CSRF-TOKEN': token},
                credentials: "same-origin",
                body: JSON.stringify({})
            }
        ).then(response => {
            this.setState({
                treeData: [{
                    title: this.getUsers(response.data, 'parent'),
                    children: this.getUsers(response.data, 'children'),
                }]
            });
        }).catch(function (error) {
            console.log(error);
        })
    }

    /**
     *
     * @param data
     * @param addUser
     */
    addNodeUser(currentUser, addUser) {
        let newTree = addNodeUnderParent({
            treeData: this.state.treeData,
            newNode: addUser,
            // path: currentUser.id,
            // expandParent: false,
            expanded: false,
            parentKey: currentUser.id - 1, // Still don't know where to get the parentKey
            getNodeKey: ({treeIndex}) => treeIndex,
        })
        this.setState({treeData: newTree.treeData});
    }


    /**
     *
     * @param e
     * @param data
     */
    getUsersToPosition(e, currentUser) {
        axios.get("/staff_tree/" + currentUser.id, {
                headers: {'X-CSRF-TOKEN': token},
                credentials: "same-origin",
                body: JSON.stringify({})
            }
        ).then(response => {
            let users = this.getUsers(response.data, 'children');
            users.map((addUser) =>
                this.addNodeUser(currentUser, addUser)
            )
        }).catch(function (error) {
            console.log(error);
        })
    }

    /**
     *
     * @param path_image
     * @returns {*}
     */
    static checkIfImage(path_image) {
        return (path_image) ? path_image : 'img/default.png';
    }

    /**
     *
     * @param data
     * @returns {Array}
     */
    getUsers(data, type_user) {
        let childrenItems = [];

        if (type_user === "children") {
            data.map((items) =>
                childrenItems.push({
                    title: ([
                        <div key={items.child_users.id}>
                            <div className="app-left-block">
                                <img onClick={(e) => this.getUsersToPosition(e, items.child_users)}
                                     src={Tree.checkIfImage(items.child_users.image)} className="app-tree-image"/>
                            </div>
                            <div className="app-right-block">
                                <div className="app-up-block">
                                    <span className="app-user-name">Full name:
                                        {items.child_users.surname + ' ' + items.child_users.first_name + ' ' + items.child_users.patronymic},
                                    </span>
                                    <span
                                        className="app-user-position">Position: number-{items.child_users.position_id},</span>
                                </div>
                                <div className="app-down-block">
                                    <span
                                        className="app-user-pay-amount">Salary: {items.child_users.amount_of_wages}$,</span>
                                    <span
                                        className="app-user-start-date">Employment date: {items.child_users.date_engagement}.</span>
                                </div>
                            </div>
                        </div>
                    ])
                })
            )
            return childrenItems;

        } else if (type_user === "parent") {
            childrenItems.push([
                <div key={data[0].parent_users.id}>
                    <div className="app-left-block">
                        <img src={Tree.checkIfImage(data[0].parent_users.image)} className="app-tree-image"/>
                    </div>
                    <div className="app-right-block">
                        <div className="app-up-block">
                             <span className="app-user-name">Full name:
                                 {data[0].parent_users.surname + ' ' + data[0].parent_users.first_name + ' ' + data[0].parent_users.patronymic},
                            </span>
                            <span
                                className="app-user-position">Position number-{data[0].parent_users.position_id},</span>
                        </div>
                        <div className="app-down-block">
                            <span
                                className="app-user-pay-amount">Salary: {data[0].parent_users.amount_of_wages}$,</span>
                            <span
                                className="app-user-start-date">Employment date: {data[0].parent_users.date_engagement}.</span>
                        </div>
                    </div>
                </div>
            ])
            return childrenItems;
        }
    }

    render() {
        return (
            <div style={{height: 500}}>
                <SortableTree
                    canDrag={false}
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
