import './index.css'
import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import { createLogger } from 'redux-logger'
import { createStore, applyMiddleware } from 'redux'
import app from './reducers/index'
import AppContainer from './containers/AppContainer'
import ioClient from "socket.io-client";
import {
    playerAuthenticated,
    receiveLoginFail,
    receiveLoginSuccess,
    receiveLogout,
    newGameWasCreatedAction,
    receiveGameState,
    receiveJoinGamesList,
    receivePlayersOnlineList,
    receiveExitGame,
    socketConnectedAction,
    //debugServerState,
    otherPlayerJoinedGame,
    currentPlayerJoinedGame,
    receiveOtherPlayerExitGame,
} from "./actions/index";
import remoteActionMiddleware from "./middlewares/remoteAction";
import serverStateLoggerAction from "./middlewares/serverStateLoggerAction";



const socket = ioClient.connect('http://' + window.location.hostname + ':8008');
socket.on('connecting', function () {
    console.log('Соединение...');
});



let store = createStore(
    app,
    applyMiddleware(
        createLogger(),
        remoteActionMiddleware(socket),
        serverStateLoggerAction
    )
)

socket.on('connect', function () {
    //store.dispatch(socketConnectedAction())
});
socket.on('authenticated', function (player) {
    store.dispatch(playerAuthenticated(player))
});
socket.on('loginFail', function (data) {
    store.dispatch(receiveLoginFail(data.error))
});
socket.on('loginSuccess', function (data) {
    store.dispatch(receiveLoginSuccess(data.accessToken, data.player))
});
socket.on('loggedOut', function (data) {
    store.dispatch(receiveLogout())
});
socket.on('serverState', function (data) {
    //store.dispatch(debugServerState(data))
});
socket.on('newGame', function (data) {
    store.dispatch(newGameWasCreatedAction(data))
});
socket.on('exitGame', function (data) {
    store.dispatch(receiveExitGame())
});
socket.on('otherPlayerExitGame', function (data) {
    store.dispatch(receiveOtherPlayerExitGame(data.player, data.game))
});
socket.on('gameState', function (data) {
    store.dispatch(receiveGameState(data))
});
socket.on('gameWelcomeState', function (data) {
    store.dispatch(receiveJoinGamesList(data))
});
socket.on('playersOnlineList', function (data) {
    store.dispatch(receivePlayersOnlineList(data.playersOnline))
});
socket.on('otherPlayerJoinedGame', function (data) {
    store.dispatch(otherPlayerJoinedGame(data.player, data.game))
});
socket.on('currentPlayerJoinedGame', function (data) {
    store.dispatch(currentPlayerJoinedGame(data.gameId))
});


render(
    <Provider store={store}>
        <AppContainer/>
    </Provider>,
    document.getElementById('root')
)