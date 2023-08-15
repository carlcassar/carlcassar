---
title: Reset Data In A Vue Component
description: Although it’s easy to initialise a vue component with some data, it’s not immediately obvious how we might go about resetting this data to its original state once it has been modified. In this post, we take a look at two easy options.
published_at: 01-01-2019 7:12
---
[Data](https://vuejs.org/v2/api/#data) is declared on a vue component using a function that returns the initial data object. Vue will recursively convert the properties of the data object to getters and setters to make it ‘reactive’. It is often useful to be able to reset this data to its original state (the way it was when the component was initialised). It might not be immediately obvious how to do this, so we’ll take a look at two good options.

## 1. Create an initial data function
Let’s imagine that we have the following data structure:

```javascript
data() {
    return {
        a: 1,
        b: 2,
        c: 3
    }
}
```

Instead of setting the initial values of `a`, `b`, and `c` in the declaration of the data function, we can create a method that stores their initial value:

```javascript
methods: {
    initialState() {
        return {
            a: 1,
            b: 2,
            c: 3,
        }
    },
},
```

We can then set the data to this initial state:

```javascript
data() {
    return this.initialState();
}
```

Now that we have a handle on the original data, we can reset the data to its original state by mapping each property to its original state:

```javascript
methods: {
    reset() {
        this.a = this.initialState().a,
        this.b = this.initialState().b,
        this.c = this.initialState().c
    },
},
```

Or even easier, we can reset all properties at once:

```javascript
methods: {
    reset() {
        Object.assign(this.$data, this.initialState());
    },
},
```

## 2. Get the original data state from the component object
Now that we have seen how we can use an initial state function, we can look at another method to achieve the same result. A component’s data is stored on the component  in the `$options` property. Let’s assume, once again, that we have declared the following data on a component:

```javascript
data() {
    return {
        a: 1,
        b: 2,
        c: 3
    }
}
```

We can reset the data to its initial state in the following way:

```javascript
methods: {
    reset() {
        Object.assign(this.$data, this.$options.data());
    },
},
```

Although we have set the data to its original state, we have one more thing to consider. `this.$options.data()` does not bind the current context (`this`) into the `data()` function, so if we tried to reference `this` in the data function, we would get an error. To get around this, we can bind the current context into the data function as follows:

```javascript
methods: {
    reset() {
        Object.assign(this.$data, this.$options.data.apply(this);
    },
},
```

Both of the options we have looked at have their pros and cons. Whilst it  might be easier to get the data from the `$options` object, an initial state method can be useful for resetting some of the options and not others.

## Credit and References

1. [Stack Overflow](https://stackoverflow.com/questions/35604987/is-there-a-proper-way-of-resetting-a-components-initial-data-in-vuejs/35605629)
2. [GitHub Issue](https://github.com/vuejs/vue/issues/702#issuecomment-308991548)
3. Credit also goes to my work colleague, who originally showed me how to use the initial state method.
