import Spruce from '@ryangjchandler/spruce'

Spruce.store('test', {
    test: false
})

Spruce.watch('test', val => console.log(val))

export default Spruce