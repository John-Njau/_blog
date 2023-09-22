import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', {
  state: () => ({
    count: 0,
    name: 'John Doe',
    age: 20,
    address: 'Manila'
  }),

  actions: {
    increment() {
      this.count++
    }
  }
})
