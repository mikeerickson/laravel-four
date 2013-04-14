makeArray = (dimension) ->
	arr = []
	for i in [0...dimension]
		arr[i] = []
		arr[i][j] = '1111' for j in [0...dimension]
	arr
	
myArr = makeArray 4

console.log myArr
		