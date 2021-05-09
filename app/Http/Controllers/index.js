import Vue from 'vue'
import Vuex from 'vuex'
import Auth from './modules/auth'
import Book from './modules/book'
import Author from './modules/auhtor'
import Category from './modules/category'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    Auth,
    Book,
    Author,
    Category
  }
})
