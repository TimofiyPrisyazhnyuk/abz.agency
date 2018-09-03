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
    }

    /**
     * Get tree users from database from start download
     */
    componentDidMount() {
        axios.post('/staff_tree', {
                headers: {'X-CSRF-TOKEN': token},
                credentials: "same-origin",
                body: JSON.stringify({})
            }
        ).then(response => {
            // console.log(response.data);
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
        console.log(currentUser.id);
        // return;
        let newTree = addNodeUnderParent({
            treeData: this.state.treeData,
            newNode: addUser,
            // path: currentUser.id,
            expandParent: false,
            ignoreCollapsed: true,
            parentKey: currentUser.id, // Still don't know where to get the parentKey
            getNodeKey: (key) => currentUser.id,
        })
        this.setState({treeData: newTree.treeData});
    }

    /**
     * Get user from db after click to photo
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
     * Check user have own image or show default
     *
     * @param path_image
     * @returns {*}
     */
    static checkIfImage(path_image) {
        return (path_image) ? path_image : 'img/default.png';
    }

    /**
     * Create tree component each users
     */
    createTreeComponentUser(user) {
        return ([
            <div key={user.id} onClick={(e) => this.getUsersToPosition(e, user)}>
                <div className="app-left-block">
                    <img src={Tree.checkIfImage(user.image)} className="app-tree-image"/>
                </div>
                <div className="app-right-block">
                    <div className="app-up-block">
                        <span className="app-user-name">Full name:
                            {user.surname + ' ' + user.first_name + ' ' + user.patronymic},
                        </span>
                        <span className="app-user-position">Position: number-{user.position_id},</span>
                    </div>
                    <div className="app-down-block">
                        <span className="app-user-pay-amount">Salary: {user.amount_of_wages}$,</span>
                        <span className="app-user-start-date">Employment date: {user.date_engagement}.</span>
                    </div>
                </div>
            </div>
        ]);
    }

    /**
     * Get users from db (parent or child)
     *
     * @param data
     * @returns {Array}
     */
    getUsers(data, type_user) {
        let childrenItems = [];

        if (type_user === "parent") {
            childrenItems.push(
                this.createTreeComponentUser(data[0].parent_users)
            )
        } else {
            data.map((items) =>
                childrenItems.push({
                    title: this.createTreeComponentUser(items.child_users)
                })
            )
        }
        return childrenItems;
    }

    /**
     * RENDER COMPONENT TREE
     *
     * @returns {*}
     */
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


