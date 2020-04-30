# Credits: https://www.geeksforgeeks.org/print-all-combinations-of-given-length/
# This was made to test how many possible directories/links crisp.io would be able to support

combinations_num = 0

def printAllKLength(set, k): 
  n = len(set)  
  printAllKLengthRec(set, "", n, k) 

def printAllKLengthRec(set, prefix, n, k): 
  global combinations_num

  if (k == 0): 
    combinations_num += 1
    return

  for i in range(n):
    newPrefix = prefix + set[i]
    printAllKLengthRec(set, newPrefix, n, k - 1)

charSet = list("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ")

# k = 4 gives 14776336 possible combinations, 2.2 GB
# k = 5 gives 916132832 possible combinations, 137 GB
k = 1 # >> gives 62 (length of the string/list)

printAllKLength(charSet, k) 
print (combinations_num)