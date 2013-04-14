name = "Mike"

greeting = "Hello #{name}!"

multi = """ some content
some more here
and one more line here 

My name is #{name}"""

console.log multi

#next section

### 
	greeting
###

greet = (name = "friend") ->
	"Hello #{name}!"
	
console.log greet("Mike")
console.log greet "Kira"

### Splat ###

test = (x,y,z...) ->
	console.log x
	console.log y 
	console.log z
	
test "one", "two", "three"
console.log "============="
test "one", "two", "three", "four", "five", "six", "seven", 121, 12

### anonymous funtions ###

do (message="Hello") ->
	console.log "#{message} from anonymous function"
	
### random range ###

rand = (max = 10, min = 0) -> Math.floor(Math.random() * (max - min + 1)) + min

console.log rand()
console.log rand 100
console.log rand 60, 50	
console.log " "

### Objects ###

obj = { name: "Mike", address: "6372 Flint", city: "Huntington Beach", state: "CA", kids: ["Joelle","Brady","Bailey","Trevor"]}
myArr = ["a", "b", "c", "d", "e", "f", obj]

for item in myArr 
	console.log item