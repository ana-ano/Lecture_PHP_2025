df = mtcars

# 1. 'wt' სვეტის კატეგორიების დაყოფა
br = c(1.513, 2.780, 3.570, 5.450)
levels = c('A', 'B', 'C')

df$categories = cut(df$wt, br, levels, right = TRUE, include.lowest = TRUE)
df

# 2. A კატეგორიის მანქანების ამოღება (hp < 230 ან mpg > 20)
A_category = df[df$categories == 'A' & (df$hp < 230 | df$mpg > 20), ]
percentage_gear_gt_3 = mean(A_category$gear > 3) * 100
percentage_gear_gt_3


# 3. B კატეგორიის მანქანების ამოღება (disp > 275 ან carb > 1)
B_category = df[df$categories == 'B' & (df$disp > 275 | df$carb > 1), ]
percentage_gear_gt_2 = mean(B_category$gear > 2) * 100
percentage_gear_gt_2

# 4. A და B კატეგორიის მანქანების ამოღება (vs != 1 და hp მაქსიმუმი)

filtered_df = max(df$hp[df$categories == 'A' | df$categories == 'B' & df$vs != 1])
filtered_df

#მეხუთე იმ მონაცემებში, რომლებისთვისაც vs სვეტის ელემენტები არ უდრის 1-ს და
# am არ უდრის 0-ს რისი ტოლია mpg სვეტის მაქსიმუმი.

filtered_df = df[(df$vs != 1) & (df$am != 0), ]

max_mpg = max(filtered_df$mpg)

max_mpg



